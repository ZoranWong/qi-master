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

    public function profile()
    {
        /** @var User $user */
        $user = $this->repository
            ->withCount(['orderWaitOffer', 'orderWaitHire', 'orderWaitPay', 'orderWaitCheck', 'orderWaitComment'])
            ->find(auth()->id());

        return $this->response->item($user, new UserTransformer);
    }

}
