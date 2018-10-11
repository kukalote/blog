<?php

namespace App\Library;

use Illuminate\Support\Facades\Redis;

class Tools
{

    /**
     * 远程请求-单个请求
     */
    public static function curl($url, $params=[], $is_post=false, $https=0)
    {
        $httpInfo = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
        }
        if ($is_post) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            if ($params) {
                if (is_array($params)) {
                    $params = http_build_query($params);
                }
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }

        $response = curl_exec($ch);

        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);
        return $response;
    }

    public static function multipleCurl()
    {
    }

    /**
     * 支持 set, hset, hmset 命令保存数据
     * 通过匿名方法生成数据
     * 并 get, hget 返回数据
     */
    public static function getRedisVars($redis_key, $func, $redis_column='')
    {
        if (empty($redis_column)) {
            $redis_val = Redis::get($redis_key);
        } else {
            $redis_val = Redis::hget($redis_key, $redis_column);
        }
        if (empty($redis_val)) {
            $redis_val = call_user_func($func);
            if (empty($redis_val)) {
                $redis_val = NULL;
            } elseif (is_array($redis_val)) {
                $arguments = array();
                foreach ($redis_val as $key=>$val) {
                    $arguments[] = $key;
                    $arguments[] = $val;
                }
                $arguments = array_merge([$redis_key], $arguments);
                Redis::command('hmset', $arguments);
                $redis_val = $redis_val[$redis_column] ?? NULL;
            } else {
                if (empty($redis_column)) {
                    $arguments = [$redis_key, $redis_val];
                    Redis::command('set', $arguments);
                } else {
                    $arguments = [$redis_key, $redis_column, $redis_val];
                    Redis::command('hset', $arguments);
                }
            }
        }
        return $redis_val;
    }

}

