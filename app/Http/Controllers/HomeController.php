<?php

namespace App\Http\Controllers;

use Dingo\Api\Routing\UrlGenerator;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index()
    {
        return view('web.index');
    }

    public function register()
    {
        return view('web.register');
    }

    public function resetPassword()
    {
        return view('web.psw');
    }

    public function login()
    {
        return view('web.login')->with([
            'loginRoute' => app(UrlGenerator::class)->version('v1')->route('user.login')
        ]);
    }
}
