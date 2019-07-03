<?php

namespace App\Api\Controllers\Master;

use App\Api\Controller;
use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Transformers\Master\NewOrderTransformer;
use App\Transformers\OrderDetailTransformer;
use App\Transformers\OrderTransformer;

class OrderController extends Controller
{
    protected $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $paginator = $this->repository->getList();

        return $this->response->paginator($paginator, new OrderTransformer);
    }

    public function detail(Order $order)
    {
        dd(auth()->id(), $order->masterId);
        if (auth()->id() !== $order->masterId) {
            $this->response->errorForbidden('您无权查看不属于您的订单详情');
        }

        $order = $this->repository->with(['comment', 'classification', 'serviceType'])->find($order->id);

        return $this->response->item($order, new OrderDetailTransformer);
    }

    public function newOrders()
    {
        $paginator = $this->repository->getNewOrderList();

        return $this->response->paginator($paginator, new NewOrderTransformer);
    }

}
