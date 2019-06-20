<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    //
    public function message()
    {
        if(isMobile()){

        }else{
            return view('web.message')->with([
                'selected' => 'message',
                'currentMenu' => 'message'
            ]);
        }
    }
}
