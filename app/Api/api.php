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
        require_once app_path('Api/user-api.php');

        /**
         * 师傅
         */
        require_once app_path('Api/master-api.php');
    });
});