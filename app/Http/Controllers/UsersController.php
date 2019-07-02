<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function profile()
    {
        $view = null;
        $user = auth()->user();
        if(isMobile()){

        }else{
            $view = view('web.profile')->with([
                'selected' => 'profile',
                'currentMenu' => 'profile'
            ]);
        }
        return $view->with([
            'user' => $user
        ]);
    }

    public function security()
    {
        if(isMobile()){

        }else{
            return view('web.security')->with([
                'selected' => 'profile',
                'currentMenu' => 'security'
            ]);
        }
    }

    public function recharge()
    {
        if(isMobile()){

        }else{
            return view('web.recharge')->with([
                'selected' => 'wallet',
                'currentMenu' => 'recharge'
            ]);
        }
    }
}
