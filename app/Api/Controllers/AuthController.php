<?php

namespace App\Api\Controllers;

use App\Api\Controller;

class AuthController extends Controller
{
    public function login()
    {
        $credential = request(['mobile', 'password']);

        if (!($token = auth()->attempt($credential))) {
            $this->response->errorUnauthorized('账号密码不匹配');
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
            'token' => 'bearer ' . $token,
            'expire_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
