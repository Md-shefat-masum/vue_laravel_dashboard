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
        Route::post('/store', 'Management\BranchAssetCategoryController@store');
        Route::post('/update', 'Management\BranchAssetCategoryController@update');
        Route::post('/soft-delete', 'Management\BranchAssetCategoryController@soft_delete');
        Route::post('/restore', 'Management\BranchAssetCategoryController@restore');
        Route::post('/destroy', 'Management\BranchAssetCategoryController@destroy');
        Route::post('/import', 'Management\BranchAssetCategoryController@import');
        Route::get('/{id}', 'Management\BranchAssetCategoryController@show');
    });
});
