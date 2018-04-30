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

Route::get('/', 'Auth\LoginController@index')->name('index');
Route::get('login', 'Auth\LoginController@redirectToProvider')->name('login');
Route::get('login/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('logout', 'Auth\LoginController@logut')->name('logout');

Route::namespace('Administracion')->middleware('auth')->prefix('administracion')->name('administracion.')->group(function () {
    Route::get('/', 'AdministracionController@index');
    Route::resource('permission_applications', 'Permission_applicationsController');
});

Route::get('/home', 'HomeController@index')->name('home');
