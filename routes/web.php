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

// 商品列表
Route::get('/goods/list', 'Goods\GoodsController@getgoodslist')->name('getgoodslist');
Route::post('/goods/ajaxlist', 'Goods\GoodsController@ajaxgoodslist')->name('ajaxgoodslist');
Route::get('/goods/createpage', 'Goods\GoodsController@creategoodspage')->name('creategoodspage');
Route::post('/goods/create', 'Goods\GoodsController@creategoods')->name('creategoods');
Route::get('/goods/modifypage', 'Goods\GoodsController@modifygoodspage')->name('modifygoodspage');
Route::post('/goods/modify', 'Goods\GoodsController@modifygoods')->name('modifygoods');
Route::post('/goods/delete', 'Goods\GoodsController@deletegoods')->name('deletegoods');

// 商品分类
Route::get('/goods/category', 'Goods\GoodsCategoryController@getcategorylist')->name('getcategorylist');
Route::post('/goods/ajaxcategorylist', 'Goods\GoodsCategoryController@ajaxcategorylist')->name('ajaxcategorylist');
Route::post('/goods/createcategory', 'Goods\GoodsCategoryController@createcategory')->name('createcategory');
Route::post('/goods/modifycategory', 'Goods\GoodsCategoryController@modifycategory')->name('modifycategory');
Route::post('/goods/deletecategory', 'Goods\GoodsCategoryController@deletecategory')->name('deletecategory');

// 活动中心
Route::get('/activity/list', 'activityController@getactivitylist')->name('getactivitylist');

// 客户管理
Route::get('/customer/list', 'customerController@getcustomerlist')->name('getcustomerlist');


