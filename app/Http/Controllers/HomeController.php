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
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('index', ['view_data'=>$this->_view_data]);
        return view('home');
    }
}


