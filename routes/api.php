<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group([
        'as' => 'api',
        'namespace' => 'App\Api',
    ], function ($api) {
        $api->post('register', [
            'as' => 'register',
            'uses' => 'Users\UserController@register'
        ]);
        $api->post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
        $api->post('password/reset', 'Auth\PasswordController@reset');
    });

    $api->group([
        'as' => 'api.auth',
        'namespace' => 'App\Api\Auth',
        'prefix' => 'auth',
    ], function ($api) {
        $api->post('', [
            'as' => 'login',
            'uses' => 'AuthenticationController@login'
        ]);
        $api->delete('', [
            'middleware' => 'api.auth',
            'as' => 'logout',
            'uses' => 'AuthenticationController@logout'
        ]);
        $api->get('', [
            'middleware' => 'api.auth',
            'as' => 'getUser',
            'uses' => 'AuthenticationController@checkAuth'
        ]);
    });


    $api->group([
        'as' => 'api',
        'middleware' => 'api.auth',
        'namespace' => 'App\Api',
    ], function ($api) {
        $api->resource('users', 'Users\UserController');
        $api->post('{id}/avatar', 'Users\UserController@addAvatar');
    });
});

