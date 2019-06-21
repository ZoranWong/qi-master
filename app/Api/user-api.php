<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api->group(['prefix' => 'users', 'namespace' => 'User', 'middleware' => ['web']], function (Router $api) {
    $api->put('/resetPwd', 'UserController@resetPassword');

    $api->group(['middleware' => ['auth']], function (Router $api) {
        $api->get('/profile', ['as' => 'users.profile', 'uses' => 'UserController@profile']);
        $api->put('/changePwd', ['as' => 'user.change.password', 'uses' => 'UserController@changePassword']);
        $api->put('/changeWalletPwd', ['as' => 'user.change.wallet_password', 'uses' => 'UserController@changeWalletPassword']);
        $api->put('/resetWalletPwd', ['as' => 'user.reset.wallet_password', 'uses' => 'UserController@resetWalletPassword']);
        $api->get('/comments', 'UserController@comments');
        $api->put('/setWalletPwd', ['as' => 'user.set.wallet_password', 'uses' => 'UserController@setWalletPassword']);
        /**
         * 订单
         */
        $api->group(['prefix' => 'orders'], function (Router $api) {
            $api->get('/', 'OrderController@index');
            $api->get('/{order}', 'OrderController@detail');
            $api->post('/fixedPrice/publish', 'OrderController@publishFixedPrice');
            $api->post('/publish', 'OrderController@publish');
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
            $api->put('/readMessage', 'MessageController@read');
            $api->delete('/deleteMessage', 'MessageController@destroy');
        });
    });
});
