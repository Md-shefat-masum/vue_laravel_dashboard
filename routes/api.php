<?php

use App\Http\Middleware\AuthApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group([
    // 'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'
], function () {
    Route::post('register', 'Auth\ApiAuthController@register');
    Route::post('login', 'Auth\ApiAuthController@login');
    Route::post('logout', 'Auth\ApiAuthController@logout');
    Route::post('refresh', 'Auth\ApiAuthController@refresh');
    Route::post('me', 'Auth\ApiAuthController@me');
});

Route::group([
    'middleware' => AuthApi::class,
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'v1',
], function () {

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'Management\UserController@index');
        Route::post('/store', 'Management\UserController@store');
        Route::post('/update', 'Management\UserController@update');
        Route::post('/soft-delete', 'Management\UserController@soft_delete');
        Route::post('/restore', 'Management\UserController@restore');
        Route::post('/destroy', 'Management\UserController@destroy');
        Route::post('/import', 'Management\UserController@import');
        Route::get('/{id}', 'Management\UserController@show');
    });

    Route::group(['prefix' => 'media'], function () {
        Route::post('/upload', 'Management\MediaController@upload');
        Route::delete('/delete', 'Management\MediaController@delete');
    });
});
