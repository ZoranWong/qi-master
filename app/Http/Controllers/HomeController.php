<?php

namespace App\Http\Controllers;

use Dingo\Api\Dispatcher;


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
//        $data = $dispatcher->get(api_route('user.profile'));
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
