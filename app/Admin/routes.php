<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('/user', 'UserController');
    $router->resource('/cate', 'CategoryController');
    $router->resource('/cartoon', 'CartoonController');
    $router->resource('/cartoon_list', 'Cartoon_listController');
    $router->resource('/listScript', 'ScriptController');




    $router->post('listscript', 'ScriptController@listScript');
    $router->post('setfreestatus', 'CartoonController@setFreeStatus');
});
