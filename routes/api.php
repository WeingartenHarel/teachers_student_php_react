<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users','UserController@index')->middleware('api');

Route::post('/users/login','UserController@login')->middleware('api');


Route::post('/users/register','UserController@storeuser')->middleware('api');



Route::middleware('auth:api')->get('/user/single/{token}', 'UserController@singleUser');


Route::middleware('auth:api')->put('/user/single/update', 'UserController@updateSingleUser');


Route::middleware('auth:api')->put('/user/single/updateuserpassword', 'UserController@updateUserpassword');



//period related routes


Route::middleware('auth:api')->post('/period/create', 'PeriodController@storePeriod');


Route::get('/teacher/period/single/{token}', 'PeriodController@myPeriod');