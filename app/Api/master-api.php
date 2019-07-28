<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api->group(['prefix' => 'masters', 'namespace' => 'Master'], function (Router $api) {
    $api->group(['middleware' => ['auth']], function (Router $api) {
        $api->get('/profile', ['as' => 'masters.profile', 'uses' => 'MasterController@profile']);
        $api->get('/offerOrders', ['as' => 'masters.offer_orders', 'uses' => 'OfferOrderController@index']);
        $api->get('/newOrders', ['as' => 'masters.new_orders', 'uses' => 'OrderController@newOrders']);
        $api->get('/newOrders/{order}', ['as' => 'masters.new_orders.detail', 'uses' => 'OrderController@newOrderDetail']);
        $api->put('/changePwd', ['as' => 'masters.change_password', 'uses' => 'MasterController@changePassword']);
        $api->put('/changeWalletPwd', ['as' => 'masters.change_wallet_password', 'uses' => 'MasterController@changeWalletPassword']);
        $api->put('/setWalletPwd', ['as' => 'masters.set_wallet_password', 'uses' => 'MasterController@setWalletPassword']);
        $api->post('/service_info/update', ['as' => 'masters.update_service_info', 'uses' => 'MasterController@updateServiceInfo']);
        $api->get('/order_statistics', ['as' => 'masters.order_statistics', 'uses' => 'MasterController@getOrderStatistics']);
        /**
         * 订单
         */
        $api->group(['prefix' => 'orders'], function (Router $api) {
            $api->get('/', ['as' => 'master.orders.list', 'uses' => 'OrderController@index']);
            $api->get('/{order}', ['as' => 'master.orders.detail', 'uses' => 'OrderController@detail']);
            $api->post('/{order}/offer', ['as' => 'master.order.offer', 'uses' => 'OfferOrderController@store']);
            $api->put('/{order}/reserve', ['as' => 'master.order.reserve', 'uses' => 'OfferOrderController@reserve']);
            $api->put('/{order}/check_in', ['as' => 'master.order.check_in', 'uses' => 'OfferOrderController@checkIn']);
            $api->put('/{order}/pick_up', ['as' => 'master.order.pick_up_product', 'uses' => 'OfferOrderController@pickUpProduct']);
            $api->put('/{order}/secondary/reserve', ['as' => 'master.order.reserve.secondary', 'uses' => 'OfferOrderController@reserveSecondary']);
            $api->put('/{order}/check/request', ['as' => 'master.order.reserve.check.request', 'uses' => 'OfferOrderController@requestCheck']);
            $api->put('/{order}/completed', ['as' => 'master.order.completed', 'uses' => 'OfferOrderController@completedOrder']);
        });
        /**
         * 投诉
         */
        $api->group(['prefix' => 'complaints'], function (Router $api) {
            $api->get('/', ['as' => 'master.complaints.list', 'uses' => 'ComplaintController@index']);
            $api->get('/{complaint}', ['as' => 'master.complaints.detail', 'uses' => 'ComplaintController@detail']);
            $api->post('/{complaint}/evidence', ['as' => 'master.complaint.evidence', 'uses' => 'ComplaintController@evidence']);// 举证
        });
        /**
         * 退款
         */
        $api->group(['prefix' => 'refunds'], function (Router $api) {
            $api->get('/', ['as' => 'master.refunds.list', 'uses' => 'RefundOrderController@index']);
            $api->get('/{refundOrder}', ['as' => 'master.refunds.detail', 'uses' => 'RefundOrderController@detail'])
                ->where(['refundOrder' => '[0-9]+']);
            $api->put('/{refundOrder}/settle', ['as' => 'master.refunds.settle', 'uses' => 'RefundOrderController@settle']);// 退款处理
        });
        /**
         * 评价
         */
        $api->group(['prefix' => 'comments'], function (Router $api) {
            $api->get('/', ['as' => 'master.comments.list', 'uses' => 'CommentController@index']);
            $api->get('/{comment}', ['as' => 'master.comments.detail', 'uses' => 'CommentController@detail']);
        });
        /**
         * 消息
         */
        $api->group(['prefix' => 'messages'], function (Router $api) {
            $api->get('/', ['as' => 'master.messages.list', 'uses' => 'MessageController@index']);
        });
    });
});
