<?php

namespace App\Api\Controllers\Master;

use App\Api\Controller;
use App\Http\Requests\ComplaintItemRequest;
use App\Models\Complaint;
use App\Repositories\ComplaintRepository;
use App\Transformers\ComplaintDetailTransformer;
use App\Transformers\ComplaintItemTransformer;
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
        })->orderBy('created_at', 'desc')->paginate($limit);

        return $this->response->paginator($paginator, new ComplaintTransformer);
    }

    public function detail(Complaint $complaint)
    {
        if ($complaint->order->masterId !== auth()->id()) {
            $this->response->errorForbidden('您与涉及订单无关，无权查看');
        }

        return $this->response->item($complaint, new ComplaintDetailTransformer);
    }

    /**
     * 举证
     * @param ComplaintItemRequest $request
     * @param Complaint $complaint
     * @return Response
     */
    public function evidence(ComplaintItemRequest $request, Complaint $complaint)
    {
        if (auth()->id() !== $complaint->order->masterId) {
            $this->response->errorForbidden('您与此项投诉无关，不可以举证');
        }

        $postData = $request->only(['content', 'evidence']);

        $postData['complainant_id'] = auth()->id();

        $postData['complainant_type'] = Inflector::singularize(config('auth.defaults.guard'));

        $complaintItem = $complaint->items()->create($postData);

        return $this->response->item($complaintItem, new ComplaintItemTransformer);
    }
}