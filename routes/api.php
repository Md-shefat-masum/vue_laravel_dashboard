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
        Route::get('/', 'Management\User\User\UserController@index');
        Route::post('/store', 'Management\User\User\UserController@store');
        Route::post('/update', 'Management\User\User\UserController@update');
        Route::post('/soft-delete', 'Management\User\User\UserController@soft_delete');
        Route::post('/restore', 'Management\User\User\UserController@restore');
        Route::post('/destroy', 'Management\User\User\UserController@destroy');
        Route::post('/import', 'Management\User\User\UserController@import');
        Route::get('/{id}', 'Management\User\User\UserController@show');
    });

    Route::group(['prefix' => 'user-roles'], function () {
        Route::get('/', 'Management\User\Role\UserRoleController@index');
        Route::post('/store', 'Management\User\Role\UserRoleController@store');
        Route::post('/update', 'Management\User\Role\UserRoleController@update');
        Route::post('/soft-delete', 'Management\User\User\UserRoleController@soft_delete');
        Route::post('/restore', 'Management\User\Role\UserRoleController@restore');
        Route::post('/destroy', 'Management\User\Role\UserRoleController@destroy');
        Route::post('/import', 'Management\User\Role\UserRoleController@import');
        Route::get('/{id}', 'Management\User\Role\UserRoleController@show');
    });

    Route::group(['prefix' => 'profile'], function () {
        Route::post('/update-info', 'Management\User\Profile\ProfileController@update_info');
        Route::post('/update-password', 'Management\User\Profile\ProfileController@update_password');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/fields', 'Management\SettingController@fields');
        Route::get('/{group_id}/{sub_group_id}/values', 'Management\SettingController@values');
        Route::post('/update', 'Management\SettingController@update');
    });

    Route::group(['prefix' => 'media'], function () {
        Route::post('/upload', 'Management\MediaController@upload');
        Route::delete('/delete', 'Management\MediaController@delete');
    });
});
