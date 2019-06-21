<?php

namespace App\Api\Controllers\User;

use App\Api\Controller;
use App\Http\Requests\UserUpdatePasswordRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Transformers\MasterCommentTransformer;
use App\Transformers\UserTransformer;
use Dingo\Api\Http\Request;
use Dingo\Api\Http\Response;

class UserController extends Controller
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 个人信息
     */
    public function profile()
    {
        /** @var User $user */
        $user = $this->repository
            ->withCount(['orderWaitOffer', 'orderWaitHire', 'orderWaitPay', 'orderWaitCheck', 'orderWaitComment'])
            ->find(auth()->id());

        return $this->response->item($user, new UserTransformer);
    }

    /**
     * 修改密码：已知原密码
     * @param UserUpdatePasswordRequest $request
     */
    public function changePassword(UserUpdatePasswordRequest $request)
    {
        $data = $request->only(['old_password', 'password']);

        $user = auth()->user();

        if (!password_verify($data['password'], $user->getAuthPassword())) {
            $this->response->errorBadRequest('原密码错误');
        }

    }

    /**
     * 重置密码：丢失原密码，找回密码
     */
    public function resetPassword()
    {
        password_verify('password', 'has');
    }

    /**
     * 修改钱包密码：已知原钱包密码
     */
    public function changeWalletPassword()
    {

    }

    /**
     * 重置钱包密码：丢失原钱包密码，找回钱包密码
     */
    public function resetWalletPassword()
    {

    }

    /**
     * 评论列表
     * @param Request $request
     * @return Response
     */
    public function comments(Request $request)
    {
        $limit = $request->input('limit', PAGE_SIZE);

        $paginator = auth()->user()->comments()
            ->with(['order.classification', 'order.serviceType', 'master'])
            ->paginate($limit);

        return $this->response->paginator($paginator, new MasterCommentTransformer);
    }
}
