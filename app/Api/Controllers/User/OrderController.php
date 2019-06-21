<?php

namespace App\Api\Controllers\User;

use App\Api\Controller;
use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Transformers\OrderDetailTransformer;
use App\Transformers\OrderTransformer;
use Dingo\Api\Http\Request;

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

    public function index(Request $request)
    {
        $limit = $request->input('limit', PAGE_SIZE);

        $paginator = auth()->user()->orders()->paginate($limit);

        return $this->response->paginator($paginator, new OrderTransformer);
    }

    public function detail(Order $order)
    {
        return $this->response->item($order, new OrderDetailTransformer);
    }
}
