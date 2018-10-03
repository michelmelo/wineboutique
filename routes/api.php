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
Route::name('api.')->namespace('Api')->group(function () {
    // Unprotected routes
    Route::group(['middleware' => 'guest:api'], function () {
        Route::get('/cities', 'LocationsController@cities')->name('cities');
        Route::get('/locations/{city}', 'LocationsController@locations')->name('locations');

        Route::namespace('Auth')->prefix('auth')->group(function () {
            Route::post('/register', 'RegisterController@register')->name('register');
            Route::post('/check-email', 'RegisterController@checkEmail')->name('email');
        });
    });

    // Protected routes
    Route::middleware('auth:api')->group(function () {
    });
});