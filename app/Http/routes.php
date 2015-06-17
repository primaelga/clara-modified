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
    //return "hello";
    return $app->welcome();
});


$app->get('api/service','App\Http\Controllers\DataController@index');
 
$app->get('api/service/{table}','App\Http\Controllers\DataController@ReadService');
 
$app->post('api/service/{table}','App\Http\Controllers\DataController@CreateService');
 
$app->put('api/service/{table}/{key}','App\Http\Controllers\DataController@UpdateService');
 
$app->delete('api/service/{table}/{key}','App\Http\Controllers\DataController@DeleteService');
 