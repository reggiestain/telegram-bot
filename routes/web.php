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

Route::get('/', function () {
    return view('welcome');
});

//Route::middleware(['auth'])->prefix('admin')->namespace('Backend')->name('admin')->group(function(){
    //Route::get('/','DashboardController@index')->name('index');
    Route::get('/settings','TelegramController@getMe')->name('getMe');
    Route::get('/settings/store','SettingsController@store')->name('store');
    
//});

Auth::routes();

Route::match(['post','get'],'register', function (){
   Auth::logout();
   return redirect('/');   
})->name('register');

//Route::get('/home','HomeController')->name('home');

