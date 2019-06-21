<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api->group(['prefix' => 'users', 'namespace' => 'User', 'middleware' => ['web']], function (Router $api) {
    $api->get('/profile', ['as' => 'users.profile', 'uses' => 'UserController@profile']);
    $api->put('/changePwd', 'UserController@changePassword');
    $api->put('/resetPwd', 'UserController@resetPassword');
    $api->put('/changeWalletPwd', 'UserController@changeWalletPassword');
    $api->put('/resetWalletPwd', 'UserController@resetWalletPassword');
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
        $api->get('/', 'ComplaintController@index');
        $api->get('/{complaint}', 'ComplaintController@detail');
        $api->post('/{complaint}/evidence', 'ComplaintController@evidence');
        $api->post('/', 'ComplaintController@store');
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
        $api->get('/', 'MessageController@index');
        $api->get('/readMessage', 'MessageController@read');
        $api->get('/deleteMessage', 'MessageController@destroy');
    });
});
