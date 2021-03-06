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
        $router->put('users/{order}/status/update', 'UsersController@updateStatus')->name('user.status.update');

        /**
         * 师傅管理页面
         * */
        $router->group(['prefix' => 'masters'], function (Router $router) {
            $router->get('/', 'MasterController@index')->name('admin.masters.index');
            $router->get('/{master}', 'MasterController@show')->name('admin.masters.show');
            $router->put('/{master}/status/update', 'MasterController@updateStatus')->name('admin.masters.updateStatus');
        });

        $router->group(['prefix' => 'coupons'], function (Router $router) {
            $router->post('users/{userId}/send', 'CouponCodesController@sendUserCoupon');
        });

        /**
         * 投诉类型
         * */
        $router->group(['prefix' => 'complaint_types'], function (Router $router) {
            $router->get('/', 'ComplaintTypesController@index')->name('admin.complaint.types.index');
            $router->get('/create', 'ComplaintTypesController@create')->name('admin.complaint.types.create');
            $router->post('/', 'ComplaintTypesController@store');
            $router->get('/{id}/edit', 'ComplaintTypesController@edit');
            $router->put('/{id}', 'ComplaintTypesController@update');
        });


        /**
         * 产品管理
         * */
        $router->group(['prefix' => 'products'], function (Router $router) {
            $router->get('/', 'ProductsController@index');
            $router->get('/create', 'ProductsController@create');
            $router->post('/', 'ProductsController@store');
            $router->get('/{id}/edit', 'ProductsController@edit');
            $router->put('/{id}', 'ProductsController@update');
        });

        /**
         * 品牌管理页面
         * */
        $router->group(['prefix' => 'brands'], function (Router $router) {
            $router->get('/', 'BrandController@index');
            $router->get('/create', 'BrandController@create');
            $router->post('/', 'BrandController@store');
            $router->get('/{id}/edit', 'BrandController@edit');
            $router->put('/{id}', 'BrandController@update');
        });


        /**
         * 订单管理页面
         * */
        $router->group(['prefix' => 'orders'], function (Router $router) {
            $router->get('/', 'OrdersController@index')->name('admin.orders.index');
            $router->get('/{order}', 'OrdersController@show')->name('admin.orders.show');
        });

        /**
         * 提现管理
         * */
        $router->group(['prefix' => 'withdraw_orders'], function (Router $router) {
            $router->get('/', 'WithdrawDepositOrderController@index')->name('admin.withdraw.index');
            $router->get('/{order}', 'WithdrawDepositOrderController@show')->name('admin.withdraw.show');
            $router->put('/{order?}', 'WithdrawDepositOrderController@update')->name('admin.withdraw.update');
        });

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
            $router->get('/top', 'CategoriesController@topCategories')->name('admin.categories.top');
            $router->get('/children', 'CategoriesController@childCategories')->name('admin.categories.children');
            $router->get('/create', 'CategoriesController@create');
            $router->post('/', 'CategoriesController@store');
            $router->get('/{category}/edit', 'CategoriesController@edit');
            $router->put('/{category}', 'CategoriesController@update');
            $router->get('/{category}', 'CategoriesController@show');
            $router->delete('/{category}', 'CategoriesController@destroy');
            $router->get('/{category}/properties', 'CategoriesController@properties');
            $router->get('/{category}/requirements', 'CategoriesController@requirements');
        });
        /**
         * 服务类型管理
         */
        $router->group(['prefix' => 'service_types'], function (Router $router) {
            $router->get('/', 'ServiceTypeController@index');
            $router->get('/create', 'ServiceTypeController@create');
            $router->post('/', 'ServiceTypeController@store');
            $router->get('/{serviceType}/edit', 'ServiceTypeController@edit');
            $router->put('/{serviceType}', 'ServiceTypeController@update');
            $router->get('/{serviceType}', 'ServiceTypeController@show');
            $router->delete('/{serviceType}', 'ServiceTypeController@destroy');
        });

        $router->group(['prefix' => 'articles'], function (Router $router) {
            $router->get('/', 'ArticleController@index');
            $router->get('/create', 'ArticleController@create');
            $router->post('/', 'ArticleController@store');
            $router->get('/{article}/edit', 'ArticleController@edit');
            $router->get('/{article}', 'ArticleController@show');
            $router->put('/{article}', 'ArticleController@update');
            $router->delete('/{article}', 'ArticleController@destory');
        });

        $router->resource('banners', "BannerController");
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
