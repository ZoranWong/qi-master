<?php

namespace App\Api\Controllers;

use App\Models\Banner;
use App\Transformers\BannerTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    //
    public function index()
    {
        $banners = Banner::orderBy('created_at', 'desc')->paginate();
        return $this->response->paginator($banners, new BannerTransformer());
    }
}
