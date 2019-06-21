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
        if (auth()->id() !== $order->userId) {
            $this->response->errorForbidden('您无权查看该订单');
        }

        return $this->response->item($order, new OrderDetailTransformer);
    }

    /**
     * 发布报价招标订单
     */
    public function publish()
    {

    }

    /**`、
     * 发布一口价订单
     */
    public function publishFixedPrice()
    {

    }
}
