<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
//    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
//	$router->resource('users', UserController::class);
    $router->resource('qrcode', QrcodeController::class);
    $router->resource('expression', ExpressionController::class);
    $router->resource('wheat', WheatController::class);
});
