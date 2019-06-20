<?php

namespace App\Api\Controllers\User;

use App\Api\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Transformers\UserTransformer;

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
     */
    public function changePassword()
    {

    }

    /**
     * 重置密码：丢失原密码，找回密码
     */
    public function resetPassword()
    {

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
}
