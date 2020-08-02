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
| is assigned the "Api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:Api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::middleware('auth:Api')->get('/me/create', 'Api\TokensController@create');
Route::middleware('auth:Api')->get('/me/remove/{id}', 'Api\TokensController@destroy');
Route::middleware('auth:Api')->post('/me/create', 'Api\TokensController@create');
Route::middleware('auth:Api')->post('/me/remove/{id}', 'Api\TokensController@destroy');