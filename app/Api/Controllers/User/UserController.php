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
use Illuminate\Http\JsonResponse;

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
     * @return JsonResponse
     */
    public function changePassword(UserUpdatePasswordRequest $request)
    {
        $data = $request->only(['old_password', 'password']);

        /** @var User $user */
        $user = auth()->user();

        // 缺少session或者session过期
        if (is_null($user)) {
            $this->response->errorUnauthorized();
        }

        if (!password_verify($data['old_password'], $user->password)) {
            $this->response->errorBadRequest('原密码错误');
        }

        if (password_verify($data['password'], $user->password)) {
            $this->response->errorBadRequest('新密码不能和原密码一样');
        }

        $user->update(['password' => bcrypt($data['password'])]);

        auth()->logout();

        return response()->json([
            'message' => '密码修改成功'
        ]);
    }

    /**
     * 重置密码：丢失原密码，找回密码
     * @param UserUpdatePasswordRequest $request
     * @return JsonResponse
     */
    public function resetPassword(UserUpdatePasswordRequest $request)
    {
        $password = $request->input('password');

        $mobile = $request->input('mobile');

        $user = $this->repository->findByField('mobile', $mobile);

        if (count($user) === 0) {
            $this->response->errorNotFound('没有找到与手机号码匹配的账户');
        }

        /** @var User $user */
        $user = $user[0];

        if (password_verify($password, $user->password)) {
            $this->response->errorBadRequest('新密码不能和原密码一样');
        }

        $user->update(['password' => bcrypt($password)]);

        auth()->logout();

        return response()->json([
            'message' => '密码重置成功'
        ]);
    }

    /**
     * 设置钱包密码
     * @param UserUpdatePasswordRequest $request
     * @return JsonResponse
     */
    public function setWalletPassword(UserUpdatePasswordRequest $request)
    {
        $walletPassword = $request->input('password');

        auth()->user()->update(['wallet_password' => bcrypt($walletPassword)]);

        return response()->json([
            'message' => '钱包密码已设置'
        ]);
    }

    /**
     * 修改钱包密码：已知原钱包密码
     * @param UserUpdatePasswordRequest $request
     * @return JsonResponse
     */
    public function changeWalletPassword(UserUpdatePasswordRequest $request)
    {
        $data = $request->only(['password', 'old_password']);

        /** @var User $user */
        $user = auth()->user();

        if ($data['password'] === $data['old_password']) {
            $this->response->errorBadRequest('新钱包密码不可与原钱包密码一样');
        }

        if (!password_verify($data['old_password'], $user->walletPassword)) {
            $this->response->errorBadRequest('原钱包密码错误');
        }

        $user->update(['wallet_password' => bcrypt($data['password'])]);

        return response()->json([
            'message' => '钱包密码已修改'
        ]);
    }

    /**
     * 重置钱包密码：丢失原钱包密码，找回钱包密码
     * @param UserUpdatePasswordRequest $request
     * @return JsonResponse
     */
    public function resetWalletPassword(UserUpdatePasswordRequest $request)
    {
        $data = $request->only(['password', 'mobile']);

        /** @var User $user */
        $user = auth()->user();

        if (password_verify($data['password'], $user->walletPassword)) {
            $this->response->errorBadRequest('新钱包密码不能和原钱包密码一样');
        }

        $user->update(['wallet_password' => bcrypt($data['password'])]);

        return response()->json([
            'message' => '钱包密码重置成功'
        ]);
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
