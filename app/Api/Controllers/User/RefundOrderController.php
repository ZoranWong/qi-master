<?php

namespace App\Api\Controllers\User;

use App\Api\Controller;
use App\Http\Requests\RefundOrderCreateRequest;
use App\Jobs\RefundOrderAutoCompleted;
use App\Models\Order;
use App\Models\RefundOrder;
use App\Repositories\OrderRepository;
use App\Repositories\RefundOrderRepository;
use App\Transformers\RefundDetailTransformer;
use App\Transformers\RefundOrderTransformer;
use Dingo\Api\Http\Response;
use Illuminate\Support\Carbon;

class RefundOrderController extends Controller
{
    protected $repository;

    public function __construct(RefundOrderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 我的退款记录
     */
    public function index()
    {
        $paginator = $this->repository->with(['order', 'master', 'classification', 'serviceType'])->getList();

        return $this->response->paginator($paginator, new RefundOrderTransformer);
    }

    /**
     * 我的退款详情
     * @param RefundOrder $refundOrder
     * @return Response
     */
    public function detail(RefundOrder $refundOrder)
    {
        if (auth()->id() !== $refundOrder->userId) {
            $this->response->errorUnauthorized('您无权查看不属于您的退款');
        }

        $refundOrder = $this->repository->with(['order'])->find($refundOrder->id);

        return $this->response->item($refundOrder, new RefundDetailTransformer);
    }

    /**
     * 发起我的退款
     * @param RefundOrderCreateRequest $request
     * @param OrderRepository $orderRepository
     * @return Response
     */
    public function initRefund(RefundOrderCreateRequest $request, OrderRepository $orderRepository)
    {
        $data = $request->only(['order_id', 'amount', 'remark', 'refund_mode', 'refund_method']);

        /** @var Order $order */
        $order = $orderRepository->find($data['order_id']);
        if ($order->userId !== auth()->id()) {
            $this->response->errorUnauthorized('您无权对不属于您的订单发起退款');
        }
        if (count($this->repository->findWhere(['order_id' => $order->id]))) {
            $this->response->errorForbidden('同一订单只可退款一次');
        }
        if ($data['refund_mode'] === RefundOrder::REFUND_MODE_PARTIAL && $order->totalAmount - 5 < $data['amount']) {
            $this->response->errorBadRequest('为了资金交易安全，部分退款金额剩余的订单服务费不得低于5元，或可进行全额退款操作');
        } else if ($data['refund_mode'] === RefundOrder::REFUND_MODE_ALL && $order->totalAmount != $data['amount']) {
            $this->response->errorBadRequest('全额退款金额错误');
        }
        $data['user_id'] = $order->userId;
        $data['master_id'] = $order->masterId;
        $data['status'] = RefundOrder::REFUND_STATUS_WAIT;
        $data['apply_status'] = RefundOrder::APPLY_STATUS_WAIT;

        /**@var RefundOrder $refund*/
        $refund = $this->repository->create($data);
        app('sms')->sendSms($refund->master->mobile, 'refund_apply', [
            'master' => $refund->master->realName ? $refund->master->realName : $refund->master->name,
            'orderNo' => $refund->order->orderNo,
            'day' => config('order.refund_auto_completed_day')
        ]);
        $this->dispatch((new RefundOrderAutoCompleted($refund))->delay(Carbon::now()->addDays(config('order.refund_auto_completed_day'))));
        return $this->response->item($refund, new RefundOrderTransformer);
    }

    /**
     * 发起客服介入需求
     * @param RefundOrder $refundOrder
     * @return Response
     */
    public function needCustomer(RefundOrder $refundOrder)
    {
        if ($refundOrder->userId !== auth()->id()) {
            $this->response->errorUnauthorized('您无权干涉不属于您的订单退款');
        }

        $refundOrder->update(['has_customer' => true, 'status' => RefundOrder::REFUND_STATUS_HANDLING]);

        return $this->response->array([
            'message' => 'OK',
            'code' => 'SUCCESS'
        ]);
    }

    /**
     * 取消退款
     * @param RefundOrder $refundOrder
     * @return Response
     */
    public function cancel(RefundOrder $refundOrder)
    {
        if ($refundOrder->userId !== auth()->id()) {
            $this->response->errorUnauthorized('您无权干涉不属于您的订单退款');
        }

        $refundOrder->update(['status' => RefundOrder::REFUND_STATUS_CLOSED]);

        return $this->response->array([
            'message' => 'OK',
            'code' => 'SUCCESS'
        ]);
    }
}
