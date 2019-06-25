<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api->group(['prefix' => 'masters', 'namespace' => 'Master'], function (Router $api) {


    $api->group(['middleware' => ['auth']], function (Router $api) {
        $api->get('/profile', ['as' => 'masters.profile', 'uses' => 'MasterController@profile']);
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
         * 消息
         */
        $api->group(['prefix' => 'messages'], function (Router $api) {

        });
    });
});
