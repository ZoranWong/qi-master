<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dingo\Api\Dispatcher;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\Log;


class HomeController extends Controller
{
    use Helpers, ApiDispatcher;
    //
    public function index()
    {
        /**@var User $user**/
        $user = auth()->user();
        /**@var Dispatcher $dispatcher**/
        $dispatcher = $this->dispatcher();
        try{
            $user = $dispatcher->get('/users/profile');
        }catch (\Exception $exception){
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
        $orders = $user->orders()->offset(0)->limit(10)->get();
        $view->with('user', $user)->with('orders', $orders);
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
