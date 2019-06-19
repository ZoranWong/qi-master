<?php

namespace App\Api\Controllers;

use App\Api\Controller;

class UsersController extends Controller
{
    public function profile()
    {
        return auth()->user();
    }
}
