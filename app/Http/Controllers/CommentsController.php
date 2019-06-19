<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentsController extends Controller
{
    //
    public function index()
    {
        if (isMobile()) {

        } else {
            return view('web.comment')->with([
                'currentMenu' => 'comments',
                'selected' => 'orders'
            ]);
        }
    }
}
