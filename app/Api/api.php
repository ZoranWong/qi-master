<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api->version('v1', ['namespace' => 'App\Api\Controllers'], function (Router $api) {

    $api->group(['prefix' => 'auth/users', 'middleware' => ['guard:users']], function (Router $api) {
        $api->post('login', 'AuthController@login');
        $api->post('logout', 'AuthController@logout');
    });

    $api->group(['prefix' => 'auth/masters', 'middleware' => ['guard:masters']], function (Router $api) {
        $api->post('login', 'AuthController@login');
        $api->post('logout', 'AuthController@logout');
    });

    $api->group(['middleware' => ['refresh.token']], function (Router $api) {
        $api->get('users/profile', 'UsersController@profile');
    });
});
