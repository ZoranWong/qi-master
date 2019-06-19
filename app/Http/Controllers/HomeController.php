<?php

namespace App\Http\Controllers;

use Dingo\Api\Routing\UrlGenerator;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index()
    {
        if (isMobile()) {
            return view('h5.index');
        } else {
            return view('web.index');
        }

    }

    public function register()
    {
        if (isMobile()) {
            return view('h5.register');
        } else {
            return view('web.register');
        }

    }

    public function resetPassword()
    {
        return view('web.psw');
    }

    public function login()
    {
        if (isMobile()) {
            return view('h5.login')->with([
                'loginRoute' => app(UrlGenerator::class)->version('v1')->route('user.login')
            ]);
        } else {
            return view('web.login')->with([
                'loginRoute' => app(UrlGenerator::class)->version('v1')->route('user.login')
            ]);
        }
    }
}
