<?php
/**
 * 基础服务
 * date: 2018-10-11
 */
namespace App\Service;

use App\Entity\Result;


class BaseService
{
    protected static $containers = [];
    public function __construct()
    {
    }
    public static function getInstance()
    {
        if(array_key_exists(static::class, static::$containers) ==false ||  empty(static::$containers[static::class]))
        {
            static::$containers[static::class] =new static();
        }
        return static::$containers[static::class];
    }

    public static function CallFunc($func, ...$params)
    {
        $result = new Result();
        try {
            $data = call_user_func_array([self::getInstance(), $func], $params);
            $result->setMsg('操作成功')->setCode(Result::CODE_SUCCESS)->setData($data);
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $result->setMsg( $msg )->setCode( Result::CODE_ERROR );
        }
        return $result;
    }
    
    public static function CallFuncArray($func, $params)
    {
        return call_user_func_array([self::getInstance(), $func], $params);
    }
}

