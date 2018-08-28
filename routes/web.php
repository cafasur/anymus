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
/*
|--------------------------------------------------------------------------
| Login Alternative
|--------------------------------------------------------------------------
*/
Route::get('/login-alternative', 'Auth\LoginController@indexAlternative')->name('indexAlternative');
Route::post('/login-alternative', 'Auth\LoginController@loginAlternative')->name('loginAlternative');

Route::get('logout', 'Auth\LoginController@logut')->name('logout');

// Routes Applications
Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/profile',  'ProfileController@index')->name('profile');
    Route::put('/profile/{user}',  'ProfileController@update')->name('update.profile');

    /*
    |--------------------------------------------------------------------------
    | App Administration
    |--------------------------------------------------------------------------
    */
    Route::resource('/users', 'UsersController');

    Route::get('/roles/assign-role', 'RolesController@assign_role')->name('roles.assign_role');
    Route::post('/roles/save-assign-role', 'RolesController@save_assign_role')->name('roles.save_assign_role');
    Route::post('/roles/change-role', 'RolesController@change_role')->name('roles.change_role');
    Route::resource('/roles', 'RolesController');

    /*
    |--------------------------------------------------------------------------
    | App Formalities
    |--------------------------------------------------------------------------
    */
    Route::get('/formalities', 'FormalitiesController@index')->name('formalities.index');

    Route::get('/formalities/formato-informes-ssf',  'FormalitiesController@form_ssf')->name('formalities.form_ssf');
    Route::post('/formalities/formato-informes-ssf/getReports',  'FormalitiesController@getReports')->name('formalities.form_ssf_get_reports');
    Route::post('/formalities/formato-informes-ssf/print',  'FormalitiesController@print')->name('formalities.form_ssf_print');

    Route::get('/formalities/formato-ausentismo',  'FormalitiesController@form_absenteeism')->name('formalities.form_absenteeism');
    Route::get('/formalities/formato-ausentismo/show/{absenteeismControl}',  'FormalitiesController@show_form_absenteeism')->name('formalities.show_form_absenteeism');
    Route::post('/formalities/formato-ausentismo/store_form_absenteeism/{user}',  'FormalitiesController@store_form_absenteeism')->name('formalities.store_form_absenteeism');
    Route::post('/formalities/formato-ausentismo/store_form_absenteeism',  'FormalitiesController@store_form_absenteeism2')->name('formalities.store_form_absenteeism2');
    Route::put('/formalities/formato-ausentismo/cancel/{absenteeismControl}',  'FormalitiesController@cancel_form_absenteeism')->name('formalities.cancel_form_absenteeism');
    Route::put('/formalities/formato-ausentismo/refuse/{absenteeismControl}',  'FormalitiesController@refuse_form_absenteeism')->name('formalities.refuse_form_absenteeism');
    Route::put('/formalities/formato-ausentismo/approve/{absenteeismControl}',  'FormalitiesController@approve_form_absenteeism')->name('formalities.approve_form_absenteeism');
    Route::put('/formalities/formato-ausentismo/checkArrival/{absenteeismControl}',  'FormalitiesController@check_arrival_form_absenteeism')->name('formalities.check_arrival_form_absenteeism');
    Route::put('/formalities/formato-ausentismo/confirmHoursAbsent/{absenteeismControl}',  'FormalitiesController@confirm_hours_absent_form_absenteeism')->name('formalities.confirm_hours_absent_form_absenteeism');
    Route::get('/formalities/formato-ausentismo/print/{absenteeismControl}',  'FormalitiesController@print_form_absenteeism')->name('formalities.print_form_absenteeism');

    Route::get('/formalities/permission-management',  'FormalitiesController@permission_management')->name('formalities.permission_management');
});


