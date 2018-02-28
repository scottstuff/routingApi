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

header('Access-Control-Allow-Origin: *');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/historicalPrices', 'Hade\PriceController@historicalPrices');
Route::get('/histominute', 'Hade\PriceController@hisToMinute');
Route::get('/histohour', 'Hade\PriceController@hisToHour');
Route::get('/histoday', 'Hade\PriceController@hisToday');
