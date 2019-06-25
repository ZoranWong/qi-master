<?php

namespace App\Api\Controllers\User;

use App\Api\Controller;
use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Transformers\OfferOrderTransformer;
use App\Transformers\OrderDetailTransformer;
use App\Transformers\OrderTransformer;
use Dingo\Api\Http\Request;
use Dingo\Api\Http\Response;

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
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit', PAGE_SIZE);

        $paginator = auth()->user()->orders()->paginate($limit);

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

    /**
     * 发起退款
     */
    public function initiateRefund()
    {

    }
}
