<?php

namespace App\Api\Controllers\User;

use App\Api\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Transformers\ProductTransformer;
use Dingo\Api\Http\Request;
use Dingo\Api\Http\Response;

class ProductController extends Controller
{
    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 商品列表
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit', PAGE_SIZE);

        $paginator = $this->repository->paginate($limit);

        return $this->response->paginator($paginator, new ProductTransformer);
    }

    /**
     * 创建商品
     * @param ProductRequest $request
     * @return Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->only(['classification_id', 'category_id', 'child_category_id', 'title', 'image']);

        $product = $this->repository->create($data);

        return $this->response->item($product, new ProductTransformer);
    }

    /**
     * 修改商品
     * @param ProductRequest $request
     * @param Product $product
     * @return Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->only(['classification_id', 'category_id', 'child_category_id', 'title', 'image']);

        $product->update($data);

        return $this->response->noContent();
    }
}
