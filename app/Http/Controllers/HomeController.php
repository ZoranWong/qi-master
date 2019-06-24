<?php

namespace App\Http\Controllers;

use Dingo\Api\Dispatcher;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;


class HomeController extends Controller
{
    use Helpers;
    //
    public function index()
    {
        $user = auth()->user();
        $token = JWTAuth::fromUser($user);
//        $token = session('token');
        /**@var Dispatcher $dispatcher**/
        $dispatcher = $this->api->header('Authorization', "bearer {$token}");
        try{
            $data = $dispatcher->get('/users/profile?token='.$token);
            Log::debug('====', $data);
        }catch (\Exception $exception){
//            throw $exception;
//            Log::debug('-------', [api_route('user.profile'), $token]);
        }


        $view = null;
        if (isMobile()) {
            $view = view('h5.index');
        } else {
            $view = view('web.index')->with([
                'selected' => '',
                'currentMenu' => ''
            ]);
        }
        $view->with('user', $user);
        return $view;

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
