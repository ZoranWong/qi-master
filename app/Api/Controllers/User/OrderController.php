<?php

namespace App\Api\Controllers\User;

use App\Api\Controller;
use App\Http\Requests\Request;
use App\Repositories\OrderRepository;
use App\Transformers\OrderTransformer;

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

        $paginator = $this->repository->paginate($limit);

        return $this->response->collection($paginator, new OrderTransformer);
    }

    public function detail()
    {

    }
}