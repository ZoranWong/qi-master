<?php

namespace App\Api\Controllers\User;

use App\Api\Controller;
use App\Http\Requests\ComplaintItemRequest;
use App\Http\Requests\ComplaintRequest;
use App\Models\Complaint;
use App\Models\Order;
use App\Repositories\ComplaintRepository;
use App\Repositories\OrderRepository;
use App\Transformers\ComplaintDetailTransformer;
use App\Transformers\ComplaintTransformer;
use Dingo\Api\Http\Request;
use Dingo\Api\Http\Response;
use Symfony\Component\Inflector\Inflector;

class ComplaintController extends Controller
{
    protected $repository;

    public function __construct(ComplaintRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $limit = $request->input('limit', PAGE_SIZE);

        $paginator = $this->repository->whereHas('order', function ($query) {
            $query->where('user_id', auth()->id());
        })->paginate($limit);

        return $this->response->paginator($paginator, new ComplaintTransformer);
    }

    public function detail(Complaint $complaint)
    {
        if ($complaint->order->userId !== auth()->id()) {
            $this->response->errorForbidden();
        }

        return $this->response->item($complaint, new ComplaintDetailTransformer);
    }

    /**
     * 发起投诉
     * @param ComplaintRequest $request
     * @param OrderRepository $orderRepository
     * @return Response
     */
    public function store(ComplaintRequest $request, OrderRepository $orderRepository)
    {
        $postData = $request->only(['order_id', 'complaint_type_id', 'complaint_info']);

        /** @var Order $order */
        $order = $orderRepository->find($postData['order_id']);

        if (auth()->id() !== $order->userId) {
            $this->response->errorForbidden('您不是订单所有者，不可以投诉');
        }

        $postData['complaint_no'] = orderNo('P');
        $postData['order_no'] = $order->orderNo;
        $postData['status'] = Complaint::STATUS_PROCEEDING;
        $postData['evidence_status'] = Complaint::STATUS_EVIDENCE_WAIT_MASTER;
        $postData['result'] = [];

        $this->repository->create($postData);

        return $this->response->created();
    }

    /**
     * 举证
     * @param ComplaintItemRequest $request
     * @param Complaint $complaint
     * @return Response
     */
    public function evidence(ComplaintItemRequest $request, Complaint $complaint)
    {
        if (auth()->id() !== $complaint->order->userId) {
            $this->response->errorForbidden('您与此项投诉无关，不可以举证');
        }

        $postData = $request->only(['content', 'evidence']);

        $postData['complainant_id'] = auth()->id();

        $postData['complainant_type'] = Inflector::singularize(config('auth.defaults.guard'));

        $complaint->items()->create($postData);

        return $this->response->created();
    }
}
