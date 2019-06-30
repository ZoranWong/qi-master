<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidRequestException;
use App\Models\Classification;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $view = null;
        if (isMobile()) {
            $view = view('h5.gallery');
        } else {
            $view = view('web.gallery')->with([
                'selected' => 'orders',
                'currentMenu' => 'gallery'
            ]);
        }
        $query = Product::with(['classification']);
        if($request->input('classification_id', null)) {
            $query->where('classification_id', $request->input('classification_id'));
        }
        $count = $query->count();
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 20);
        $products = $query->offset(($page - 1) * $limit)
            ->limit($limit)
            ->get();
        $classifications = Classification::all();
        return $view->with([
            'products' => $products,
            'count' => $count,
            'page'  => $page,
            'limit' => $limit,
            'classifications' => $classifications
        ]);
    }

    public function favorite(Request $request)
    {
        if (isMobile()) {
            return view('h5.favorite');
        } else {
            return view('web.favorite')->with([
                'selected' => 'orders',
                'currentMenu' => 'favorite'
            ]);
        }
    }

    public function show(Product $product, Request $request)
    {
        // 判断商品是否已经上架，如果没有上架则抛出异常。
        if (!$product->on_sale) {
            throw new InvalidRequestException('商品未上架');
        }

        $favored = false;
        // 用户未登录时返回的是 null，已登录时返回的是对应的用户对象
        if ($user = $request->user()) {
            // 从当前用户已收藏的商品中搜索 id 为当前商品 id 的商品
            // boolval() 函数用于把值转为布尔值
            $favored = boolval($user->favoriteProducts()->find($product->id));
        }

        $reviews = OrderItem::query()
            ->with(['order.user', 'productSku'])// 预先加载关联关系
            ->where('product_id', $product->id)
            ->whereNotNull('reviewed_at')// 筛选出已评价的
            ->orderBy('reviewed_at', 'desc')// 按评价时间倒序
            ->limit(10)// 取出 10 条
            ->get();

        return view('products.show', [
            'product' => $product,
            'favored' => $favored,
            'reviews' => $reviews
        ]);
    }

    public function favor(Product $product, Request $request)
    {
        $user = $request->user();
        if ($user->favoriteProducts()->find($product->id)) {
            return [];
        }

        $user->favoriteProducts()->attach($product);

        return [];
    }

    public function disfavor(Product $product, Request $request)
    {
        $user = $request->user();
        $user->favoriteProducts()->detach($product);

        return [];
    }

    public function favorites(Request $request)
    {
        $products = $request->user()->favoriteProducts()->paginate(16);

        return view('products.favorites', ['products' => $products]);
    }
}
