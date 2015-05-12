<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$app->get('/', function() use ($app) {
    return $app->welcome();
});


$app->get('api/service','App\Http\Controllers\PersonController@index');
 
$app->get('api/services/{table}','App\Http\Controllers\PersonController@ReadService');
 
$app->post('api/service/{table}','App\Http\Controllers\PersonController@CreateService');
 
$app->put('api/service/{table}','App\Http\Controllers\PersonController@UpdateService');
 
$app->delete('api/service/{table}','App\Http\Controllers\PersonController@DeleteService');
 