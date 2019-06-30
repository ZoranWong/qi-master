<?php

namespace App\Api\Controllers\User;

use App\Api\Controller;
use App\Models\MasterComment;
use App\Models\OfferOrder;
use App\Models\Order;
use App\Repositories\OfferOrderRepository;
use App\Repositories\OrderRepository;
use App\Transformers\OfferOrderTransformer;
use App\Transformers\OrderDetailTransformer;
use App\Transformers\OrderTransformer;
use Carbon\Carbon;
use Dingo\Api\Http\Request;
use Dingo\Api\Http\Response;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    /**
     * @var OrderRepository $repository
     */
    protected $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 订单列表
     * @return Response
     */
    public function index()
    {
        $paginator = $this->repository->getList();

        return $this->response->paginator($paginator, new OrderTransformer);
    }

    /**
     * 订单详情
     * @param Order $order
     * @return Response
     */
    public function detail(Order $order)
    {
        if (auth()->id() !== $order->userId) {
            $this->response->errorForbidden('您无权查看该订单');
        }

        $order = $this->repository->with(['comment', 'classification', 'serviceType'])->find($order->id);

        return $this->response->item($order, new OrderDetailTransformer);
    }

    /**
     * 订单报价单
     * @param Order $order
     * @return Response
     */
    public function offerOrders(Order $order)
    {
        $offerOrders = $this->repository->getOfferOrderList($order);

        return $this->response->collection($offerOrders, new OfferOrderTransformer);
    }

    /**
     * 雇佣服务商
     * 直接雇佣不需要此步骤
     * @param Order $order
     * @param Request $request
     * @param OfferOrderRepository $offerOrderRepository
     * @return Response
     * @throws ValidationException
     */
    public function hireMaster(Order $order, Request $request, OfferOrderRepository $offerOrderRepository)
    {
        $this->validate($request, [
            'offer_order_id' => 'required|int'
        ]);

        if (auth()->id() !== $order->userId) {
            $this->response->errorForbidden('您不允许对不属于您的订单进行雇佣操作');
        }

        if ($order->status !== Order::ORDER_WAIT_HIRE) {
            $this->response->errorForbidden('订单已雇佣，不允许重复雇佣');
        }

        $offerOrderId = $request->input('offer_order_id');

        $order->offerOrders()->whereKey($offerOrderId)->update(['status' => OfferOrder::STATUS_HIRED]);

        $order->offerOrders()->whereKeyNot($offerOrderId)->update(['status' => OfferOrder::STATUS_REFUSED]);

        $order->update(['status' => Order::ORDER_EMPLOYED]);

        $hiredOffer = $offerOrderRepository->with([
            'master' => function ($query) use ($order) {
                $query->withCount([
                    // 一月合作数
                    'orders as monthly_cooperation_nums' => function ($query) use ($order) {
                        $query->where('user_id', $order->userId)->whereDate('created_at', '>=', Carbon::now()->subMonth());
                    },
                    // 一月订单数
                    'orders as monthly_order_nums' => function ($query) {
                        $query->whereDate('created_at', '>=', Carbon::now()->subMonth());
                    },
                    // 好评数
                    'orders as good_comment_order_nums' => function ($query) {
                        $query->whereHas('comment', function ($query) {
                            $query->where('type', MasterComment::TYPE_GOOD);
                        });
                    },
                    // 总订单数
                    'orders as order_nums'
                ]);
            }
        ])->find($offerOrderId);

        $hiredOffer->master->good_comment_rate = $hiredOffer->master->order_nums ? number_format($hiredOffer->master->good_comment_order_nums / $hiredOffer->master->order_nums * 100, 2) : 0;
        $hiredOffer->master->good_comment_rate .= PERCENTAGE_MARK;

        return $this->response->item($hiredOffer, new OfferOrderTransformer);
    }

    /**
     * 发布报价招标订单
     */
    public function publish()
    {

    }

    /**
     * 发布一口价订单
     */
    public function publishFixedPrice()
    {

    }
}
