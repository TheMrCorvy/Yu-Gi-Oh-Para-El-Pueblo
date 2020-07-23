<?php

use Illuminate\Http\Request;

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

Route::get('v1/{controller_name}/{function_name}/{parameter?}', function ($controller_name, $function_name, $parameter = null){

    $app = app();
    
    $controller = $app->make('\App\Http\Controllers\\' . $controller_name . 'Controller');
    
    return $controller->callAction($function_name, $parameters = array($parameter));
});

Route::post('v1/{controller_name}/{function_name}/{parameter?}', function ($controller_name, $function_name, $parameter = null, Request $request){

    $app = app();
    
    $controller = $app->make('\App\Http\Controllers\\' . $controller_name . 'Controller');
    
    return $controller->callAction($function_name, $parameters = array($request, $parameter));
});