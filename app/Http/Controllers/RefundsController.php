<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RefundsController extends Controller
{
    //
    public function refunds()
    {
        if (isMobile()) {

        } else {
            return view('web.refund')->with([
                'selected' => 'refund',
                'currentMenu' => 'refund'
            ]);
        }
    }

    public function show($id)
    {
        if (isMobile()) {

        } else {
            return view('web.refunddetail')->with([
                'selected' => 'refund',
                'currentMenu' => 'refund'
            ]);
        }
    }

    public function complaint()
    {
        if (isMobile()) {

        } else {
            return view('web.complaint')->with([
                'selected' => 'refund',
                'currentMenu' => 'complaint'
            ]);
        }
    }
}
