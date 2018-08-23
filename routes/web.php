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
    $item_list = [
        [
            'item_name' => '一级菜单',
            'item_list' => [
                [
                    'item_name' => '二级菜单',
                ],
                [
                    'item_name' => '二级菜单2',
                    'item_list' => [
                        [
                            'item_name' => '三级菜单1',
                        ],
                    ],
                ],
            ],
        ],
        [
            'item_name' => '一级菜单',
            'item_list' => [
                [
                    'item_name' => '二级菜单',
                ],
                [
                    'item_name' => '二级菜单2',
                    'item_list' => [
                        [
                            'item_name' => '三级菜单1',
                        ],
                    ],
                ],
            ],
        ],
    ];
//    return view('alert');
//    return view('child', ['title'=>'xxxxxxxxxxxtitlexxxxxxxxxx']);
    return view('index', ['item_list'=>$item_list]);
//    return view('welcome');
});
