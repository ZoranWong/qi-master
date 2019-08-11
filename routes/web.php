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
        $router->get('/auth/logout', 'Auth\\LoginController@logout')->name('user.logout');
        $router->get('', 'HomeController@index')->name('home');
        $router->get('orders', 'OrdersController@index')->name('user.orders');
        $router->get('orders/{order}', 'OrdersController@show')->name('user.order.detail');
        $router->get('orders/{order}/comment', 'CommentsController@comment')->name('user.order.comment');
        $router->get('publish/{step?}', 'OrdersController@publish')->name('user.publish.order');
        $router->get('comments', 'CommentsController@index');
        $router->get('gallery', 'ProductsController@index');
        $router->get('favorite', 'FavoriteMasterController@index');
        $router->get('refund', 'RefundsController@refunds');
        $router->get('refund/{id}', 'RefundsController@show');
        $router->get('complaint', 'ComplaintsController@index');
        $router->get('wallet', 'WalletController@show');
        $router->get('profile', 'UsersController@profile');
        $router->get('security', 'UsersController@security');
        $router->get('recharge', 'UsersController@recharge');
        $router->get('message', 'ServicesController@message');
    });

    $router->any('wx/pay/{order}', 'PaymentController@wxPay');
    $router->any('ali/pay/{order}', 'PaymentController@aliPay');
    $router->any('union/pay/{order}', 'PaymentController@unionPay');
    $router->any('/notify', 'PaymentController@notify');
    $router->any('test/ali/pay', 'PaymentController@aliPayOrderTest');
    $router->any('test/wx/pay', 'PaymentController@wxPayOrderTest');
});
