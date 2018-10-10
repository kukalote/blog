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
    public function index(Request $request)
    {
        $view_data = new ViewData($this);
//        dd($view_data->_user_info);
//        $data = ['user_info'=>$this->_user_info, 'item_list'=>$this->_item_info];
        return view('index', ['view_data'=>$view_data]);
    }
//    public function index(Request $request)
//    {
////        $data = ['user_info'=>$this->_user_info, 'item_list'=>$this->_item_info];
//        $data = ['user_info'=>$this->_user_info];
//        view('index', $data);
//        $data['item_list'] = $this->_item_info;
//        return view('index', $data);
////        return view('home');
//    }
}

class ViewData 
{
    private $_vars = [];
    private $_obj = null;
    public function __construct($obj) 
    {
        $this->_obj = $obj;
    }
    public function __get($name)
    {
        return $this->_getVar($name);
    }
    public function __isset($name)
    {
        return $this->_getVar($name);
    }
    private function _getVar($name)
    {
        if (key_exists($name, $this->_vars)) {
            return $this->_vars[$name];
        }
        try {
            $vars = $this->_obj->$name;
        } catch (\Exception $e) {
            $vars = null;
        }
        if (!empty($vars)) {
            $this->_vars[$name] = $vars;
        }
        return $vars;
    }
}
