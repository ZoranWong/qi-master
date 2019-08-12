<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api->version('v1', ['namespace' => 'App\Api\Controllers'], function (Router $api) {

    $api->get('classifications', ['as' => 'classifications.list', 'uses' => 'HomeController@classifications']);
    $api->get('service_types', ['as' => 'service_types.list', 'uses' => 'HomeController@serviceTypes']);
    $api->get('regions', ['as' => 'region.list', 'uses' => 'HomeController@regions']);
    $api->get('complaint_types', ['as' => 'complaint_type.list', 'uses' => 'HomeController@complaintTypes']);
    $api->post('upload/file', ['as' => 'upload.file', 'uses' => 'UploadController@upload']);

    $api->group(['prefix' => 'auth/users', 'middleware' => ['guard:users']], function (Router $api) {
        $api->post('login', ['as' => 'user.login', 'uses' => 'AuthController@login']);
        $api->post('logout', 'AuthController@logout');
        $api->post('register', 'AuthController@register');
    });

    $api->group(['prefix' => 'auth/masters', 'middleware' => ['guard:masters']], function (Router $api) {
        $api->post('login', 'AuthController@login');
        $api->post('logout', 'AuthController@logout');
        $api->post('register', 'AuthController@freeSettle');
    });

    $api->group(['middleware' => ['refresh.token', 'bindings']], function (Router $api) {
        /**
         * 用户
         */
        $api->group(['middleware' => ['guard:users']], function (Router $api) {
            require_once app_path('Api/user-api.php');
        });

        /**
         * 师傅
         */
        $api->group(['middleware' => 'guard:masters'], function (Router $api) {
            require_once app_path('Api/master-api.php');
        });
    });
});
