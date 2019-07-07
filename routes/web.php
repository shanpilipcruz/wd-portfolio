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

Route::get('/', 'IndexController@index');

Route::get('/sendemail', 'SendEmailController@index');
Route::post('/sendemail/send', 'SendEmailController@send');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/dashboard','DashboardController');
Route::resource('/profile', 'UserProfileController',
    ['except' => ['index', 'store', 'delete', 'edit']]);
Route::get('/users', 'DashboardController@showUsers');
