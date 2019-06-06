<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->group(['namespace' => config('admin.route.namespace')], function (Router $router) {
        $router->get('/', 'HomeController@index');
        $router->get('users', 'UsersController@index');

        $router->get('products', 'ProductsController@index');
        $router->get('products/create', 'ProductsController@create');
        $router->post('products', 'ProductsController@store');
        $router->get('products/{id}/edit', 'ProductsController@edit');
        $router->put('products/{id}', 'ProductsController@update');

        $router->get('orders', 'OrdersController@index')->name('admin.orders.index');
        $router->get('orders/{order}', 'OrdersController@show')->name('admin.orders.show');
        $router->post('orders/{order}/ship', 'OrdersController@ship')->name('admin.orders.ship');
        $router->post('orders/{order}/refund', 'OrdersController@handleRefund')->name('admin.orders.handle_refund');

        $router->get('coupon_codes', 'CouponCodesController@index');
        $router->post('coupon_codes', 'CouponCodesController@store');
        $router->get('coupon_codes/create', 'CouponCodesController@create');
        $router->get('coupon_codes/{id}/edit', 'CouponCodesController@edit');
        $router->put('coupon_codes/{id}', 'CouponCodesController@update');
        $router->delete('coupon_codes/{id}', 'CouponCodesController@destroy');
        /**
         * 类目管理
         */
        $router->get('classifications', 'ClassificationsController@index');
    });

    $router->group(['namespace' => config('admin.route.encore_namespace')], function (Router $router) {
        /**
         * 菜单管理
         */
        $router->group(['prefix' => 'menus'], function (Router $router) {
            $router->get('/', 'MenuController@index');
            $router->get('create', 'MenuController@create');
            $router->post('/', 'MenuController@store');
            $router->delete('/{menu}', 'MenuController@destroy');
            $router->get('/{menu}/edit', 'MenuController@edit');
            $router->put('/{menu}', 'MenuController@update');
            $router->get('/{menu}', 'MenuController@show');
        });
        /**
         * 管理员管理
         */
        $router->group(['prefix' => 'admins'], function (Router $router) {
            $router->get('/', 'UserController@index');
            $router->get('/create', 'UserController@create');
            $router->post('/', 'UserController@store');
            $router->delete('/{user}', 'UserController@destroy');
            $router->get('/{user}', 'UserController@show');
            $router->get('/{user}/edit', 'UserController@edit');
            $router->put('/{user}', 'UserController@update');
        });
    });
});
