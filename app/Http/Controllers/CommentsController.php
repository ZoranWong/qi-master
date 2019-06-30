<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    //
    public function index(Request $request)
    {
        /**@var User $user**/
        $user = auth()->user();
        $view = null;
        if (isMobile()) {

        } else {
            $view = view('web.comment');
        }
        $view->with([
            'currentMenu' => 'comments',
            'selected' => 'orders'
        ]);
        $query = $user->comments()->with(['order']);
        if($request->input('status', null)) {
            $query->where('status', $request->input('status'));
        }
        $type = $request->input('type', null);
        $count = $query->count();
        $limit = $request->input('limit', 15);
        $page = $request->input('page', 1);
        $comments = $query->offset(($page - 1) * $limit)->limit($limit)->get();
        return $view->with([
            'page' => $page,
            'limit' => $limit,
            'count' => $count,
            'comments' => $comments,
            'type' => $type
        ]);
    }
}
