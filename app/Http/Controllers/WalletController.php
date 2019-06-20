<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WalletController extends Controller
{
    //

    public function show()
    {
        if (isMobile()) {

        }else{
            return view('web.wallet')->with([
                'selected' => 'wallet',
                'currentMenu' => 'wallet'
            ]);
        }
    }
}
