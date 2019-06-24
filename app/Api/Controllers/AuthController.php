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

        /** @var User|Master $user */
        $guard = config('auth.defaults.guard');
        $provider = config("auth.guards.{$guard}.provider");
        if (config("auth.guards.{$guard}.driver") === 'jwt') {
            $userClass = config("auth.providers.{$provider}.model");
            $user = new $userClass;
            $customClaims = $user->getJWTCustomClaims();
            auth()->claims($customClaims);
        }

        if (!($token = auth()->attempt($credential))) {
            $this->response->errorUnauthorized('账号密码不匹配');
        }

        if (is_bool($token) && $token) {
            return response()->json(['message' => 'Successfully logged in']);
        }

        return $this->responseWithToken($token);
    }

    public function register(UserCreateRequest $request, UserRepository $userRepository)
    {
        $credential = $request->only('mobile', 'password');

        /** @var User|Master $user */
        $userRepository->create([
            'mobile' => $credential['mobile'],
            'password' => bcrypt($credential['password']),
        ]);

        $token = auth()->attempt($credential);

        if (is_bool($token) && $token) {
            return response()->json([
                'message' => 'Successfully registered'
            ]);
        }

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
            'user' => auth()->user(),
            'token' => 'bearer ' . $token
        ]);
    }
}
