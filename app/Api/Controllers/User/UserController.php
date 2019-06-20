<?php

namespace App\Api\Controllers\User;

use App\Api\Controller;
use App\Transformers\UserTransformer;

class UserController extends Controller
{
    public function profile()
    {
        $user = auth()->user();

        return $this->response->item($user, new UserTransformer);
    }

}
