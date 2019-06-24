<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api->group(['prefix' => 'users', 'namespace' => 'User', 'middleware' => []], function (Router $api) {
    $api->put('/resetPwd', 'UserController@resetPassword');

    $api->group(['middleware' => ['auth']], function (Router $api) {
        $api->get('/profile', ['as' => 'user.profile', ['uses' => 'UserController@profile']]);
        $api->put('/changePwd', ['as' => 'user.change.password', 'uses' => 'UserController@changePassword']);
        $api->put('/changeWalletPwd', ['as' => 'user.change.wallet_password', 'uses' => 'UserController@changeWalletPassword']);
        $api->put('/resetWalletPwd', ['as' => 'user.reset.wallet_password', 'uses' => 'UserController@resetWalletPassword']);
        $api->get('/comments', ['as' => 'user.comments.list', 'uses' => 'UserController@comments']);
        $api->put('/setWalletPwd', ['as' => 'user.set.wallet_password', 'uses' => 'UserController@setWalletPassword']);
        $api->get('/favouriteMasters', ['as' => 'user.favourite_masters.list', 'uses' => 'UserController@favouriteMasters']);
        // 收藏师傅
        $api->post('/master/favourite', ['as' => 'user.master.favourite', 'uses' => 'UserController@favouriteMaster']);
        // 师傅备注修改
        $api->put('/favouriteMasters/editRemark', ['as' => 'user.favourite_masters.edit', 'uses' => 'UserController@updateFavouriteMaster']);
        /**
         * 订单
         */
        $api->group(['prefix' => 'orders'], function (Router $api) {
            $api->get('/', ['as' => 'user.order.list', 'uses' => 'OrderController@index']);
            $api->get('/{order}', ['as' => 'user.order.detail', 'uses' => 'OrderController@detail']);
            $api->post('/fixedPrice/publish', ['as' => 'user.publish.fixed_price', 'uses' => 'OrderController@publishFixedPrice']);
            $api->post('/publish', ['as' => 'user.publish', 'uses' => 'OrderController@publish']);
            $api->post('/initiateRefund', ['as' => 'user.initiate_refund', 'uses' => 'OrderController@initiateRefund']);
        });
        /**
         * 投诉
         */
        $api->group(['prefix' => 'complaints'], function (Router $api) {
            $api->get('/', ['as' => 'user.complaints.list', 'uses' => 'ComplaintController@index']);
            $api->get('/{complaint}', ['as' => 'user.complaint.detail', 'uses' => 'ComplaintController@detail']);
            $api->post('/{complaint}/evidence', ['as' => 'user.complaint.evidence', 'uses' => 'ComplaintController@evidence']);// 举证
            $api->post('/', ['as' => 'user.post_complaint', 'uses' => 'ComplaintController@store']);// 发起投诉
        });
        /**
         * 商品
         */
        $api->group(['prefix' => 'products'], function (Router $api) {
            $api->get('/', ['as' => 'user.products.list', 'uses' => 'ProductController@index']);
            $api->post('/', ['as' => 'user.upload_product', 'uses' => 'ProductController@store']);// 上传商品
            $api->put('/{product}', ['as' => 'user.edit_product', 'uses' => 'ProductController@update']);// 编辑商品
        });
        /**
         * 消息
         */
        $api->group(['prefix' => 'messages'], function (Router $api) {
            $api->get('/', ['as' => 'user.messages', 'uses' => 'MessageController@index']);
            $api->put('/readMessage', ['as' => 'user.read_message', 'uses' => 'MessageController@read']);
            $api->delete('/deleteMessage', ['as' => 'user.delete_message', 'uses' => 'MessageController@destroy']);
        });
        /**
         * 退款
         */
        $api->group(['prefix' => 'refunds'], function (Router $api) {
            $api->get('/', ['as' => 'uses.refunds.list', 'uses' => 'RefundOrderController@index']);
        });
    });
});
