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
            return view('web.index')->with([
                'selected' => '',
                'currentMenu' => ''
            ]);
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

    public function forgetPassword()
    {
        if(isMobile()){
            return view('web.forgetpsw');
        }else{
            return view('web.forgetpsw');
        }
    }

    public function login()
    {
        if (isMobile()) {
            return view('h5.login')->with([
                'loginRoute' => route('user.login'),
                'homePage' => route('home')
            ]);
        } else {
            return view('web.login')->with([
                'loginRoute' => route('user.login'),
                'homePage' => route('home')
            ]);
        }
    }
}
