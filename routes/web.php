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
// 公共路由
Route::get('/','StaticController@home')->name('home');
Route::get('/help','StaticController@help')->name('help');
Route::get('/about','StaticController@about')->name('about');
Route::get('/signup','UsersController@create')->name('signup');

// 用戶路由
Route::resource('users','UsersController');






