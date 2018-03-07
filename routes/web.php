<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->get('/', function () use ($router) {
    return view('home');
});

$router->group(['namespace' => 'Admin'], function () use ($router) {
    $router->post('/admin/auth/login', 'AuthController@login');
    $router->get('/admin/auth/refresh', ['middleware' => 'refresh']);

    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->get('/admin/example/test', 'ExampleController@test');
    });
/*    $router->group(['namespace' => 'User'], function() use ($router) {
    });*/
});