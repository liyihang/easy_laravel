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

// 用户登录相关处理
Route::get('/login','SessionsController@create')->name('login');
Route::post('/login','SessionsController@store')->name('login');
Route::delete('/logout','SessionsController@destory')->name('logout');
