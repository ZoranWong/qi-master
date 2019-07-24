<?php

namespace App\Api\Controllers\User;

use App\Api\Controller;
use App\Models\Master;
use App\Models\OfferOrder;
use App\Models\Order;
use App\Repositories\MasterRepository;
use App\Repositories\OfferOrderRepository;
use App\Repositories\OrderRepository;
use App\Transformers\OfferOrderTransformer;
use App\Transformers\OrderDetailTransformer;
use App\Transformers\OrderTransformer;
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
            $this->response->errorForbidden('订单已雇佣，不允许重复报价');
        }

        $offerOrderId = $request->input('offer_order_id');

        /** @var OfferOrder $offerOrder */
        $offerOrder = $offerOrderRepository->find($offerOrderId);

        if ($offerOrder->orderId !== $order->id) {
            $this->response->errorForbidden('该报价单不属于指定订单');
        }

        $offerOrder->update(['status' => OfferOrder::STATUS_HIRED]);

        $order->offerOrders()->whereKeyNot($offerOrderId)->update(['status' => OfferOrder::STATUS_REFUSED]);

        $order->update(['status' => Order::ORDER_EMPLOYED]);

        return $this->response->item($offerOrder, new OfferOrderTransformer);
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

    public function masters(Request $request)
    {
        $search = $request->get('search', null);

        if($search) {
            $masters = Master::where('mobile', 'like', "%{$search}%")
                //->orWhere('name', 'like', "%{$search}%")
                ->orWhere('real_name', 'like', "%{$search}%")
                ->get();
            return $this->response->array($masters->toArray());
        }else{
            return $this->response->array([]);
        }
    }
}
