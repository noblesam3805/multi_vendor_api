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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', 'articlecontroller@login');
Route::post('activate/{id}', 'articlecontroller@activate');
Route::post('reg', 'articlecontroller@reg');
Route::post('mail', 'articlecontroller@mail');
Route::get('token', 'articlecontroller@token');
Route::get('token', 'articlecontroller@token');
Route::post('product', 'articlecontroller@store');
Route::post('order', 'articlecontroller@order');
Route::get('products', 'articlecontroller@index');
Route::get('getorders/{id}', 'articlecontroller@getorders');
Route::post('removeorder/{id}', 'articlecontroller@destroy');
Route::put('completed/{id}', 'articlecontroller@completed');
Route::post('update/{id}', 'articlecontroller@u_user');
// Route::get('articles/{id}', 'articlecontroller@show');

// Route::put('article', 'articlecontroller@store');

