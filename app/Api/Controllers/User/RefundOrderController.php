<?php

namespace App\Api\Controllers\User;

use App\Api\Controller;
use App\Models\RefundOrder;
use App\Repositories\RefundOrderRepository;
use App\Transformers\RefundDetailTransformer;
use App\Transformers\RefundOrderTransformer;
use Dingo\Api\Http\Response;

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
            $this->response->errorUnauthorized('您无权查看不属于您的退款详情');
        }

        return $this->response->item($refundOrder, new RefundDetailTransformer);
    }
}
