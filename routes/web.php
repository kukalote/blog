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

// 模板测试 

Route::get('/child', function(){
    return view('child');
});
//Route::get('/', '');
//Route::middleware('checklogin')->get('/auth/login', 'Auth\LoginController@login');
//Route::get('/test/runinsert', 'TestController@anyruninsert');
Route::get('/makecity', 'TestController@anyMakecity');
Route::get('/makeweather', 'TestController@anyMakecityWeather');
Route::get('/makeposition', 'TestController@anyMakeCityPosition2');

//redis测试
Route::get('testRedis','RedisController@testRedis')->name('testRedis');

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
// 用户操作
Route::get('/manage/user/list', 'Manage\UserController@getuserlist')->name('getuserlist');
Route::post('/manage/user/create', 'Manage\UserController@createuser')->name('createuser');
Route::post('/manage/user/delete', 'Manage\UserController@deleteuser')->name('deleteuser');
Route::post('/manage/user/edit', 'Manage\UserController@edituser')->name('edituser');

// 栏目管理
Route::get('/manage/menu/list', 'Manage\MenuController@getmenulist')->name('getmenulist');
Route::post('/manage/menu/tree', 'Manage\MenuController@getmenutree')->name('getmenutree');
Route::post('/manage/menu/create', 'Manage\MenuController@createmenu')->name('createmenu');
Route::post('/manage/menu/delete', 'Manage\MenuController@deletemenu')->name('deletemenu');
Route::post('/manage/menu/modify', 'Manage\MenuController@modifymenu')->name('modifymenu');


