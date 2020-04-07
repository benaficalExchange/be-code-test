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

Route::post('login', 'AuthController@authenticate');

Route::middleware('auth:api')->prefix('organisation')->group(function () {
    Route::get('list-all', 'OrganisationController@listAll')->name('list-all');
    Route::post('create', 'OrganisationController@create')->name('create');
});
