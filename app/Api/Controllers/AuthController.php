<?php

namespace App\Api\Controllers;

use App\Api\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Master;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * @param UserUpdateRequest $request
     * @return JsonResponse
     */
    public function login(UserUpdateRequest $request)
    {
        $credential = $request->only(['mobile', 'password']);

        if (!($token = auth()->attempt($credential))) {
            $this->response->errorUnauthorized('账号密码不匹配');
        }

        return $this->responseWithToken($token);
    }

    public function register(UserCreateRequest $request, UserRepository $userRepository)
    {
        $credential = $request->only('mobile', 'password', 'name');

        /** @var User|Master $user */
        $userRepository->create([
            'mobile' => $credential['mobile'],
            'password' => bcrypt($credential['password']),
            'name' => $credential['name']
        ]);

        $token = auth()->attempt($credential);

        return $this->responseWithToken($token);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    protected function responseWithToken($token)
    {
        return response()->json([
            'token' => 'bearer ' . $token,
            'expire_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
