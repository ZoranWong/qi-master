<?php

namespace App\Http\Controllers;

use Dingo\Api\Dispatcher;
use Dingo\Api\Routing\UrlGenerator;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class HomeController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        $token = session('token');
        /**@var Dispatcher $dispatcher**/
        $dispatcher = app(Dispatcher::class);
        $dispatcher->header('Authorization', "bearer {$token}");
        $data = $dispatcher->get(api_route('user.profile'));
        var_dump($data);
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
        if (isMobile()) {
            return view('web.forgetpsw');
        } else {
            return view('web.forgetpsw');
        }
    }

    public function login()
    {
        if (!auth()->guest()) {
            return redirect(route('home'));
        }
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
