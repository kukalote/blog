<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Library\Tools;
use App\Entity\City;

class CommonController extends Controller
{
    const WIDGET_WEATHER_CACHE = 'wwc'; // 挂件-天气缓存

    private $_data = array();

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        $item_list = [['item_name'=>'item_name', 'url'=>''], ['item_name'=>'item_name', 'url'=>'', 'item_list'=>[['item_name'=>'sub_item', 'url'=>'']]]];
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
            'logo' => url('assets/img/favicon.png'),
        ];
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
