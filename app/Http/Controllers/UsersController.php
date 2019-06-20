<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function profile()
    {
        if(isMobile()){

        }else{
            return view('web.profile')->with([
                'selected' => 'profile',
                'currentMenu' => 'profile'
            ]);
        }
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