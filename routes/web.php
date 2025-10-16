<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () {
    return response()->json([
        'app_name' => 'Lumen Todo App',
        'version' => '1.0.0',
        'framework' => 'Lumen 10.x (Laravel Micro Framework)',
        'description' => 'A lightweight RESTful API built with Lumen for managing todos and categories.',
        'author' => [
            'name' => 'Qiyamuddin Ahmadzai',
            'email' => 'qiyam.ahmadzai@example.com',
            'location' => 'Kabul, Afghanistan'
        ],
        'features' => [
            'CRUD operations for Todos',
            'Category-based organization',
            'Status tracking (Pending, In Progress, Completed)',
            'Due date management',
            'RESTful JSON API responses'
        ],
        'routes' => [
            'GET /api/categories' => 'List all categories',
            'POST /api/categories' => 'Create new category',
            'GET /api/categories/{id}' => 'Get category by ID',
            'PUT /api/categories/{id}' => 'Update category',
            'DELETE /api/categories/{id}' => 'Delete category',

            'GET /api/todos' => 'List all todos (with categories)',
            'POST /api/todos' => 'Create new todo',
            'GET /api/todos/{id}' => 'Get todo by ID',
            'PUT /api/todos/{id}' => 'Update todo',
            'DELETE /api/todos/{id}' => 'Delete todo'
        ],
        'database_schema' => [
            'categories' => [
                'id', 'name', 'created_at', 'updated_at'
            ],
            'todos' => [
                'id', 'category_id', 'title', 'description', 'status', 'due_date', 'created_at', 'updated_at'
            ]
        ],
        'license' => 'MIT License',
        'status' => 'Running'
    ]);
});


$router->group(['prefix' => 'api'], function () use ($router) {
    // Categories
    $router->get('categories', 'CategoryController@index');
    $router->post('categories', 'CategoryController@store');
    $router->get('categories/{id}', 'CategoryController@show');
    $router->put('categories/{id}', 'CategoryController@update');
    $router->delete('categories/{id}', 'CategoryController@destroy');

    

    
});


$router->group(['prefix' => 'api'], function () use ($router) {

    // Public routes
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');

    // Protected routes
    $router->group(['middleware' => 'auth:api'], function () use ($router) {
        $router->get('me', 'AuthController@me');
        $router->post('logout', 'AuthController@logout');
        $router->post('refresh', 'AuthController@refresh');

        // Todos
        $router->get('todos', 'TodoController@index');
        $router->post('todos', 'TodoController@store');
        $router->get('todos/{id}', 'TodoController@show');
        $router->put('todos/{id}', 'TodoController@update');
        $router->delete('todos/{id}', 'TodoController@destroy');


    });
});
