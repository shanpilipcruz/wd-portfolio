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

Auth::routes(['verify' => true]);
Route::get('/', 'IndexController@index');

Route::get('/sendemail', 'SendEmailController@index');
Route::post('/sendemail/send', 'SendEmailController@send');

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/dashboard','DashboardController');
Route::resource('/profile', 'UserProfileController',
    ['except' => ['index', 'delete', 'edit']]);

Route::get('/profile/create/{id}', 'UserProfileController@create');
Route::post('/profile/store/{id}', 'UserProfileController@store');

Route::get('/users', 'DashboardController@showUsers');
Route::post('crop-image', ['as' => 'upload.image', 'uses' => 'ImageController@uploadPhoto']);
