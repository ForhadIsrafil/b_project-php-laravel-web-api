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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('user', 'App\Http\Controllers\UserController@index');
Route::post('user/register', 'App\Http\Controllers\UserController@register');
Route::post('user/login', 'App\Http\Controllers\UserController@login');
Route::get('user/token/{token}', 'App\Http\Controllers\UserController@activate_account');
Route::middleware('auth:sanctum')->get('user/logout', 'App\Http\Controllers\UserController@logout');

//Blogs
Route::middleware('auth:sanctum')->get('blogs', 'App\Http\Controllers\BlogController@index');
Route::middleware('auth:sanctum')->get('blogs/{id}', 'App\Http\Controllers\BlogController@show');
Route::middleware('auth:sanctum')->post('blogs/create', 'App\Http\Controllers\BlogController@create');


// random images
Route::get('random/images', 'App\Http\Controllers\BlogController@random_images');
