<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api->version('v1', ['namespace' => 'App\Api\Controllers'], function (Router $api) {

    $api->group(['prefix' => 'auth/users', 'middleware' => ['guard:users']], function (Router $api) {
        $api->post('login', ['as' => 'user.login', 'uses' => 'AuthController@login']);
        $api->post('logout', 'AuthController@logout');
        $api->post('register', 'AuthController@register');
    });

    $api->group(['prefix' => 'auth/masters', 'middleware' => ['guard:masters']], function (Router $api) {
        $api->post('login', 'AuthController@login');
        $api->post('logout', 'AuthController@logout');
        $api->post('register', 'AuthController@register');
    });

    $api->group(['middleware' => ['refresh.token']], function (Router $api) {
        /**
         * 用户
         */
        $api->group(['prefix' => 'masters'], function (Router $api) {
            $api->get('/profile', ['as' => 'users.profile', 'uses' => 'MasterController@profile']);
        });
        /**
         * 订单
         */
        $api->group(['prefix' => 'orders'], function (Router $api) {
            $api->get('/', 'OrderController@index');
            $api->get('/{order}', 'OrderController@detail');
        });
        /**
         * 投诉
         */
        $api->group(['prefix' => 'complaints'], function (Router $api) {

        });
        /**
         * 商品
         */
        $api->group(['prefix' => 'gallery'], function (Router $api) {

        });
        /**
         * 消息
         */
        $api->group(['prefix' => 'messages'], function (Router $api) {

        });
    });
});
