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

Route::name('api.')->namespace('Api')->group(function () {
    // Unprotected routes
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/countries', 'LocationsController@countries')->name('countries');
        Route::get('/cities', 'LocationsController@cities')->name('cities');
        Route::get('/locations/{city}', 'LocationsController@locations')->name('locations');

        Route::get('/languages', 'LanguageController@list')->name('languages');
        Route::get('/currencies', 'CurrencyController@list')->name('currencies');

        Route::namespace('Auth')->prefix('auth')->group(function () {
            Route::post('/check-email', 'RegisterController@checkEmail')->name('email');
        });
    });
});