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

        //  Categories
        $router->post('/admin/categories', 'CategoriesController@create');
        $router->get('/admin/categories/{id}', 'CategoriesController@read');
        $router->put('/admin/categories/{id}', 'CategoriesController@update');
        $router->delete('/admin/categories/{id}', 'CategoriesController@delete');
        //  Tags
        $router->post('/admin/tags', 'TagsController@create');
        $router->get('/admin/tags/{id}', 'TagsController@read');
        $router->put('/admin/tags/{id}', 'TagsController@update');
        $router->delete('/admin/tags/{id}', 'TagsController@delete');
        //  Posts
        $router->post('/admin/posts', 'PostsController@create');
        $router->get('/admin/posts/{id}', 'PostsController@read');
        $router->put('/admin/posts/{id}', 'PostsController@update');
        $router->delete('/admin/posts/{id}', 'PostsController@delete');
        //  PostCategory
        $router->post('/admin/post-category', 'PostCategoryController@assign');
        $router->get('/admin/post-category/{post}/{category}', 'PostCategoryController@getLinked');
        $router->delete('/admin/post-category/{post}/{category}', 'PostCategoryController@unlink');
    });

/*    $router->group(['namespace' => 'User'], function() use ($router) {
    });*/
});