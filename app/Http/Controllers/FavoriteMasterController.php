<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Dingo\Api\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class FavoriteMasterController extends Controller
{
    //
    public function index(Request $request)
    {
        /**@var Dispatcher $dispatcher**/
        $dispatcher = $this->dispatcher();
        $masters = [];
        $count = 0;
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 15);
        try{
            /**
             * @var LengthAwarePaginator $paginator
             * */
            $paginator = $dispatcher->get('/users/favouriteMasters', $request->all());
            $masters = $paginator->items();
            $count = $paginator->total();
            $page = $paginator->currentPage();
            $limit = $paginator->perPage();
        }catch (\Exception $exception){
        }
        $view = null;
        $regions = Region::where('parent_code', 0)->get();
        if (isMobile()) {
            $view = view('h5.favorite');
        } else {
            $view = view('web.favorite')->with([
                'selected' => 'orders',
                'currentMenu' => 'favorite'
            ]);
        }
        $view->with([
            'masters' => $masters,
            'page' => $page,
            'limit' => $limit,
            'count' => $count,
            'regions' => $regions
        ]);
        return $view;
    }
}
