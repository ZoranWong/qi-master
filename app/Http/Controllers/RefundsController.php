<?php

namespace App\Http\Controllers;

use App\Models\RefundOrder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class RefundsController extends Controller
{
    //
    public function refunds(Request $request)
    {
        $view = null;
        if (isMobile()) {

        } else {
            $view = view('web.refund')->with([
                'selected' => 'refund',
                'currentMenu' => 'refund'
            ]);
        }
        $refunds = [];
        $count = 0;
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 15);try{
            $dispatcher = $this->dispatcher();
            /**@var LengthAwarePaginator $page**/
            $paginator = $dispatcher->get('/refunds', $request->all());
            $refunds = $paginator->items();
            $count = $paginator->total();
            $page = $paginator->currentPage();
            $limit = $paginator->perPage();

        }catch (\Exception $exception) {

        }
        dd($refunds);
        $view->with([
            'masters' => $refunds,
            'page' => $page,
            'limit' => $limit,
            'count' => $count
        ]);
        return $view;
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
