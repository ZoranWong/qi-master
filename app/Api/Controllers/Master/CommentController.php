<?php

namespace App\Api\Controllers\Master;

use App\Api\Controller;
use App\Models\MasterComment;
use App\Repositories\MasterCommentRepository;
use App\Transformers\Master\MasterCommentTransformer;
use Dingo\Api\Http\Response;

class CommentController extends Controller
{
    protected $repository;

    public function __construct(MasterCommentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 我的评价列表
     */
    public function index()
    {
        $paginator = auth()->user()->comments()->with('user')->orderBy('created_at', 'desc')
            ->paginate(request('limit', PAGE_SIZE));

        return $this->response->paginator($paginator, new MasterCommentTransformer);
    }

    /**
     * 评价详情
     * @param MasterComment $comment
     * @return Response
     */
    public function detail(MasterComment $comment)
    {
        return $this->response->item($comment, new MasterCommentTransformer);
    }
}
