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



Route::get('/', ['as' => 'login', 'uses' => 'Front\PagesController@login']);
Route::post('/login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);

//Bot-config route
Route::group(['prefix' => 'bot-config','middleware' => 'auth'], function() {
    Route::get('/dashboard', ['as' => 'admin.dashboard', 'uses' => 'Admin\PagesController@getDashboard']);
    Route::post('/dashboard', ['as' => 'admin.storeconfig', 'uses' => 'Admin\PagesController@storeconfig']);
    //Route::get('/settings', 'TelegramController@getMe')->name('getMe');
    //Route::get('/settings/store', 'SettingsController@store')->name('store');
});

Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
// Registration Routes...
Route::get('register', ['as' => 'register', 'uses' => 'Front\PagesController@register']);
Route::post('register', ['as' => 'register.post', 'uses' => 'Auth\RegisterController@register']);





