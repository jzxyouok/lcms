<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|


Route::get('/', function () {
    return view('welcome');
});
*/
/*
Route::get('install', 'InstallController@install');

Route::group(['prefix' => 'backend', 'namespace' => 'Backend'], function() {
    Route::get('login', 'AuthController@login');
    Route::post('signin', 'AuthController@signin');
});
*/
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    //Route::auth();
    Route::get('/home', 'HomeController@index');
    Route::get('/install', 'InstallController@install');

    Route::get('/login', 'AuthController@getLogin');
    Route::post('/login', 'AuthController@postLogin');

    Route::get('/dash', 'DashController@index')->name('dash.index');
    Route::get('/dash/left_main', 'DashController@leftMain');
    Route::get('/dash/crumbs', 'DashController@crumbs')->name('dash.crumbs');

    Route::resource('menus', 'MenusController');
    Route::resource('users', 'UsersController');
    Route::get('/settings', 'SettingsController@index')->name('settings.index');

});
