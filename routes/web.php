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

//Route::get('/', '');
//Route::middleware('checklogin')->get('/auth/login', 'Auth\LoginController@login');
//Route::get('/test/runinsert', 'TestController@anyruninsert');
Route::get('/makecity', 'TestController@anyMakecity');
Route::get('/makeweather', 'TestController@anyMakecityWeather');
Route::get('/makeposition', 'TestController@anyMakeCityPosition2');

//Route::middleware('checklogin')->get('/', 'Auth\LoginController@login');


// auth 生成配置 
// vendor/laravel/framework/src/Illuminate/Support/Facades/Auth.php
// vendor/laravel/framework/src/Illuminate/Routing/Router.php
Auth::routes();

// 首页
Route::get('/', function(){
    return view('welcome');
});

// 后面页面 
Route::get('home', 'HomeController@index')->name('home');

// 后台管理
Route::get('/manage/userlist', 'Manage\UserController@userlist')->name('userlist');

//redis测试
Route::get('testRedis','RedisController@testRedis')->name('testRedis');
