<?php
//
///*
//|--------------------------------------------------------------------------
//| Web Routes
//|--------------------------------------------------------------------------
//|
//| Here is where you can register web routes for your application. These
//| routes are loaded by the RouteServiceProvider within a group which
//| contains the "web" middleware group. Now create something great!
//|
//*/
use Illuminate\Routing\Router;
Route::group(['middleware' => ['guard:web']], function (Router $router) {
    $router->get('/login', 'HomeController@login')->name('login');
    $router->post('/auth/login', 'Auth\\LoginController@login')->name('user.login');
    $router->get('/register', 'HomeController@register')->name('register');
    $router->get('/forget/password', 'HomeController@forgetPassword')->name('forget.password');
    $router->group(['middleware' => ['auth']], function (Router $router) {
        $router->get('', 'HomeController@index')->name('home');
        $router->get('orders', 'OrdersController@index');
        $router->get('orders/{order}', 'OrdersController@show');
        $router->get('publish/{step?}', 'OrdersController@publish');
        $router->get('comments', 'CommentsController@index');
        $router->get('gallery', 'ProductsController@index');
        $router->get('favorite', 'FavoriteMasterController@index');
        $router->get('refund', 'RefundsController@refunds');
        $router->get('refund/{id}', 'RefundsController@show');
        $router->get('complaint', 'RefundsController@complaint');
        $router->get('wallet', 'WalletController@show');
        $router->get('profile', 'UsersController@profile');
        $router->get('security', 'UsersController@security');
        $router->get('recharge', 'UsersController@recharge');
        $router->get('message', 'ServicesController@message');
    });
});
