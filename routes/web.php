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
        //  Task-Tags
        $router->post('/api/admin/task-tags', 'TaskTagsController@create');
        $router->get('/api/admin/task-tags/{id}', 'TaskTagsController@read');
        $router->get('/api/admin/task-tags/get-back/{id}', 'TaskTagsController@getBack');
        $router->get('/api/admin/task-tags/', 'TaskTagsController@getAll');
        $router->post('/api/admin/task-tags/{id}', 'TaskTagsController@update');
        $router->delete('/api/admin/task-tags/{id}', 'TaskTagsController@delete');
        //  Posts
        $router->post('/api/admin/posts', 'PostsController@create');
        $router->get('/api/admin/posts/{id}', 'PostsController@read');
        $router->get('/api/admin/posts/get-back/{id}', 'PostsController@getBack');
        $router->get('/api/admin/posts/', 'PostsController@getAll');
        $router->post('/api/admin/posts/{id}', 'PostsController@update');
        $router->delete('/api/admin/posts/{id}', 'PostsController@delete');
        //  Store
        $router->post('/api/admin/store/post-thumbnail', 'StoreController@postThumbnail');
        //  Task
        $router->post('/api/admin/task', 'TaskController@create');
        $router->get('/api/admin/task/{id}', 'TaskController@read');
        $router->get('/api/admin/task/close/{id}', 'TaskController@close');
        $router->get('/api/admin/task/get-back/{id}', 'TaskController@getBack');
        $router->get('/api/admin/task-all[/{user}]', 'TaskController@getAll');
        $router->get('/api/admin/task-pager', 'TaskController@pager');
        $router->post('/api/admin/task/{id}', 'TaskController@update');
        $router->delete('/api/admin/task/{id}', 'TaskController@delete');
        //  Note
        $router->post('/api/admin/note', 'NoteController@create');
        $router->get('/api/admin/note/{id}', 'NoteController@read');
        $router->get('/api/admin/note/get-back/{id}', 'NoteController@getBack');
        $router->get('/api/admin/note-all[/{user}]', 'NoteController@getAll');
        $router->post('/api/admin/note/{id}', 'NoteController@update');
        $router->delete('/api/admin/note/{id}', 'NoteController@delete');
        //  Achieve
        $router->post('/api/admin/achieve', 'AchieveController@create');
        $router->get('/api/admin/achieve/{id}', 'AchieveController@read');
        $router->get('/api/admin/achieve/get-back/{id}', 'AchieveController@getBack');
        $router->get('/api/admin/achieve-all[/{user}]', 'AchieveController@getAll');
        $router->post('/api/admin/achieve/{id}', 'AchieveController@update');
        $router->delete('/api/admin/achieve/{id}', 'AchieveController@delete');
    });
});

$router->group(['middleware' => 'client'], function() use ($router) {
    $router->get('/posts', 'ClientController@getPosts');
    $router->get('/post/{id}', 'ClientController@getPost');
    $router->get('/categories', 'ClientController@getCategories');
});