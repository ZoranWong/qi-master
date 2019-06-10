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

        $router->get('service_types', 'ServiceTypeController@index');
        $router->get('service_types/create', 'ServiceTypeController@create');

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
        $router->group(['prefix' => 'classifications'], function (Router $router) {
            $router->get('/', 'ClassificationsController@index');
            $router->get('/create', 'ClassificationsController@create');
            $router->post('/', 'ClassificationsController@store');
            $router->get('/{classification}/edit', 'ClassificationsController@edit');
            $router->put('/{classification}', 'ClassificationsController@update');
            $router->get('/{classification}', 'ClassificationsController@show');
            $router->delete('/{classification}', 'ClassificationsController@destroy');
        });
        /**
         * 类别管理
         */
        $router->group(['prefix' => 'categories'], function (Router $router) {
            $router->get('/', 'CategoriesController@index');
            $router->get('/create', 'CategoriesController@create');
            $router->post('/', 'CategoriesController@store');
            $router->get('/{category}/edit', 'CategoriesController@edit');
            $router->put('/{category}', 'CategoriesController@update');
            $router->get('/{category}', 'CategoriesController@show');
            $router->delete('/{category}', 'CategoriesController@destroy');
        });
    });

    $router->group(['namespace' => config('admin.route.encore_namespace')], function (Router $router) {
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
