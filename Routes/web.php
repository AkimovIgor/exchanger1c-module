<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('plugins')->group(function() {
    Route::get('/exchanger1c', 'Exchanger1CController@index');
    Route::post('/exchange1c/config', 'Exchanger1CController@saveConfig');
});

$path = '1c_exchanger';

Route::group(['middleware' => [\Illuminate\Session\Middleware\StartSession::class]], function () use ($path) {
    Route::match(['get', 'post'], $path, 'Exchanger1CController@request');
});
