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
// public routes
Route::get('/','StaticController@home')->name('home');
Route::get('/help','StaticController@help')->name('help');
Route::get('/about','StaticController@about')->name('about');
Route::get('/signup','UsersController@create')->name('signup');

// user route
Route::resource('users','UsersController');

// deal user login
Route::get('/login','SessionsController@create')->name('login');
Route::post('/login','SessionsController@store')->name('login');
Route::delete('/logout','SessionsController@destory')->name('logout');


Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');
// reset password
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');