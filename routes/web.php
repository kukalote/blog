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
Route::middleware('checklogin')->get('/auth/login', 'Auth\LoginController@login');
Route::get('/test/runinsert', 'TestController@anyruninsert');
//Route::middleware('checklogin')->get('/', 'Auth\LoginController@login');
