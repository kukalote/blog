<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends CommonController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item_list = [['item_name'=>'item_name', 'url'=>''], ['item_name'=>'item_name', 'url'=>'', 'item_list'=>[['item_name'=>'sub_item', 'url'=>'']]]];
        return view('index', ['item_list'=>$item_list]);
//        return view('home');
    }
}
