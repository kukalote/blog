<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Library\Tools;
use App\Entity\City;
use App\Entity\Result;

class CommonController extends Controller
{
    const WIDGET_WEATHER_CACHE = 'wwc'; // 挂件-天气缓存

    const LIBRARY_CITY_CACHE = 'lcc';   // 数据库-城市缓存
    const LIBRARY_RELATE_CITY_CACHE = 'lrcc';   // 数据库-城市关系及缓存

    private $_data = array();

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct($request=null)
    {
        $this->_request = $request;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserInfo()
    {
        $user_info = Auth::user()->toArray();
        $city_data = City::where('city_id', $user_info['city_id'])->first();
        $city_arr  = empty($city_data) ? [] : $city_data->toArray();
        return array_merge($user_info, $city_arr);
    }

    /**
     * 获取菜单信息
     */
    protected function getItemInfo()
    {
        $path_info = $this->_request->getPathInfo();
        $path_step = explode('/', $path_info);
        $path_step_arr = ['primary_item'=>null, 'second_item'=>null, 'third_item'=>null];
        unset($path_step[0]);
        sort($path_step);
        if (count($path_step) == 1) {
            $path_step_arr['primary_item'] = $path_step[0];
        } elseif (count($path_step) == 2) {
            $path_step_arr['primary_item'] = $path_step[0];
            $path_step_arr['second_item']  = $path_step[1];
        } elseif (count($path_step) == 3) {
            $path_step_arr['primary_item'] = $path_step[0];
            $path_step_arr['second_item']  = $path_step[1];
            $path_step_arr['third_item']   = $path_step[2];
        }
        $item_list = [
            'step' => $path_step_arr,
            'item_list' => [
                [
                    'key' => 'home',
                    'item_name'=>'item_name',
                    'url'=>'',
                    'item_list'=> [],
                ],
                [
                    'key' => 'manage',
                    'item_name'=>'用户管理',
                    'url'=>'',
                    'item_list'=> [
                        [
                            'key' => 'user',
                            'item_name'=>'用户列表',
                            'url'=>url('manage/user/list'),
                            'item_list'=> [],
                        ],
                        [
                            'key' => 'menu',
                            'item_name'=>'菜单管理',
                            'url'=>url('manage/menu/list'),
                            'item_list'=> [],
                        ],
                    ],
                ],
            ],
        ];
        return $item_list;
    }

    /**
     * 获取日期信息
     */
    protected function getWeather($weather_code=null)
    {
        $redis_key = self::WIDGET_WEATHER_CACHE;
        $redis_column = $weather_code = $weather_code ?? $this->_user_info['weather_code'];

        $url = Config('widget.weather_url') . $weather_code;

        $weather_data = Tools::getRedisVars($redis_key, function() use ($url){
            $response_json = Tools::curl($url);
            $response = json_decode($response_json, true);
            if ($response['status'] == 200) {
                return json_encode($response['data']);
            }
            return null;
        }, $redis_column);
        $weather_arr = json_decode($weather_data, true);
        return $weather_arr;
    }


    /**
     * 获取日期信息
     */
    protected function getHead()
    {
        return [
            'title' => '管理后台',
            'description' => '管理后台描述',
            'logo' => url('/assets/img/favicon.png'),
        ];
    }

    /**
     * 获取城市信息
     */
    protected function getCitys()
    {
        $redis_key = self::LIBRARY_CITY_CACHE;
        $citys = Tools::getRedisVars($redis_key, function(){
            $citys = City::where('depth', 2)->get()->toArray();
            $citys = array_column($citys, NULL, 'city_id');
            $citys = array_map(function($val){
                return json_encode($val);
            }, $citys);
            return $citys;
        }, '*');
        $citys = array_map(function($val){
            return json_decode($val, true);
        }, $citys);
        return $citys;
    }

    /**
     * 获取城市关系及信息 @todo
     */
    protected function getRelateCitys()
    {
        $redis_key = self::LIBRARY_RELATE_CITY_CACHE;
        $citys = Tools::getRedisVars($redis_key, function(){
            $citys = City::get()->toArray();
            $citys = array_column($citys, NULL, 'city_id');
            $citys = array_map(function($val){
                return json_encode($val);
            }, $citys);
            return $citys;
        }, '*');
        $citys = array_map(function($val){
            return json_decode($val, true);
        }, $citys);
        return $citys;
    }


    /**
     * 动态获取共享数据
     */
    protected function getViewData()
    {
        $view_data = new ViewData($this);
        return $view_data;
    }

    /**
     * 获取变量 
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->_data)) {
            return $this->_data[$name];
        }

        $func_names = explode('_', $name);
        $func_names = array_map('ucfirst', $func_names);
        $func_name  = 'get'.implode('', $func_names);
        return $this->_data[$name] = call_user_func([$this, $func_name]);
    }
}

/**
 * 动态获取共享数据
 */
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
