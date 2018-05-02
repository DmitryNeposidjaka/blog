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
    $router->get('/admin{path:\/?|\/.*}', function () {
        return view('admin');
    });
    $router->post('/api/admin/auth/login', 'AuthController@login');
    $router->get('/api/admin/auth/refresh', ['middleware' => 'refresh']);

    $router->group(['middleware' => 'auth'], function () use ($router) {
        //  Users
        $router->get('/api/admin/auth/user', 'UserController@read');
        //  Categories
        $router->post('/api/admin/categories', 'CategoriesController@create');
        $router->get('/api/admin/categories/{id}', 'CategoriesController@read');
        $router->get('/api/admin/categories/get-back/{id}', 'CategoriesController@getBack');
        $router->get('/api/admin/categories/', 'CategoriesController@getAll');
        $router->post('/api/admin/categories/{id}', 'CategoriesController@update');
        $router->delete('/api/admin/categories/{id}', 'CategoriesController@delete');
        //  Tags
        $router->post('/api/admin/tags', 'TagsController@create');
        $router->get('/api/admin/tags/{id}', 'TagsController@read');
        $router->get('/api/admin/tags/get-back/{id}', 'TagsController@getBack');
        $router->get('/api/admin/tags/', 'TagsController@getAll');
        $router->post('/api/admin/tags/{id}', 'TagsController@update');
        $router->delete('/api/admin/tags/{id}', 'TagsController@delete');
        //  Posts
        $router->post('/api/admin/posts', 'PostsController@create');
        $router->get('/api/admin/posts/{id}', 'PostsController@read');
        $router->get('/api/admin/posts/get-back/{id}', 'PostsController@getBack');
        $router->get('/api/admin/posts/', 'PostsController@getAll');
        $router->post('/api/admin/posts/{id}', 'PostsController@update');
        $router->delete('/api/admin/posts/{id}', 'PostsController@delete');
        //  Store
        $router->post('/api/admin/store/post-thumbnail', 'StoreController@postThumbnail');
    });
});