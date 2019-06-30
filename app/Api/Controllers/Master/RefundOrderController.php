<?php

namespace App\Api\Controllers\Master;

use App\Api\Controller;
use App\Models\RefundOrder;
use App\Repositories\RefundOrderRepository;
use App\Transformers\RefundDetailTransformer;
use App\Transformers\RefundOrderTransformer;
use Dingo\Api\Http\Request;
use Dingo\Api\Http\Response;
use Illuminate\Validation\ValidationException;

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
     * 退款详情
     * @param RefundOrder $refundOrder
     * @return Response
     */
    public function detail(RefundOrder $refundOrder)
    {
        if (auth()->id() !== $refundOrder->masterId) {
            $this->response->errorUnauthorized('您无权查看不属于您的退款');
        }

        $refundOrder = $this->repository->with(['order'])->find($refundOrder->id);

        return $this->response->item($refundOrder, new RefundDetailTransformer);
    }

    /**
     * 处理退款
     * @param RefundOrder $refundOrder
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function settle(RefundOrder $refundOrder, Request $request)
    {
        $this->validate($request, [
            'pass' => 'required|boolean',
        ]);

        $data = $request->only(['pass', 'note']);
        $data['pass'] = (boolean)$data['pass'];
        $data['op'] = $data['pass'] ? '同意退款' : '拒绝退款';
        $data['timestamp'] = now()->format('Y-M-d H:m:s');
        $data['amount'] = $data['pass'] ? $refundOrder->amount : 0;
        $data['note'] = isset($data['note']) ? $data['note'] ?: '' : '';

        $refundOrder->update(['audit' => $data]);

        return $this->response->noContent();
    }
}