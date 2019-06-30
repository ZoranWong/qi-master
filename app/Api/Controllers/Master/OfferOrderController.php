<?php

namespace App\Api\Controllers\Master;

use App\Api\Controller;
use App\Http\Requests\OfferOrderCreateRequest;
use App\Models\Order;
use App\Repositories\OfferOrderRepository;
use App\Transformers\OfferOrderHistoryTransformer;

class OfferOrderController extends Controller
{
    protected $repository;

    public function __construct(OfferOrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $paginator = $this->repository->getList();

        return $this->response->paginator($paginator, new OfferOrderHistoryTransformer);
    }

    public function store(OfferOrderCreateRequest $request, Order $order)
    {
        $postData = $request->only(['quote_price', 'note']);

        if ($order->status >= Order::ORDER_EMPLOYED) {
            $this->response->errorForbidden('订单已雇佣，不允许报价');
        }

        $this->repository->create([
            'order_id' => $order->id,
            'user_id' => $order->userId,
            ''
        ]);
    }
}