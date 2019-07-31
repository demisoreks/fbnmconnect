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

Route::get('/', [
    'as' => 'welcome', 'uses' => 'LoginController@index'
]);
Route::post('authenticate', [
    'as' => 'authenticate', 'uses' => 'LoginController@authenticate'
]);
Route::get('change_password/{employee}', [
    'as' => 'change_password', 'uses' => 'LoginController@change_password'
]);
Route::post('update_password/{employee}', [
    'as' => 'update_password', 'uses' => 'LoginController@update_password'
]);
Route::get('dashboard', [
    'as' => 'dashboard', 'uses' => 'LoginController@dashboard'
])->middleware('auth.user');
Route::get('logout', [
    'as' => 'logout', 'uses' => 'LoginController@logout'
]);