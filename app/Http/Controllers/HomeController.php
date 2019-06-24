<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dingo\Api\Routing\UrlGenerator;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index()
    {
        $view = null;
        if (isMobile()) {
            $view = view('h5.index');
        } else {
            $view = view('web.index')->with([
                'selected' => '',
                'currentMenu' => ''
            ]);
        }
        /**@var User $user**/
        $user = auth()->user();
        dd($user);
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
                'loginRoute' => app(UrlGenerator::class)->version('v1')->route('user.login'),
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
