<?php
/**
 * 基础服务
 * date: 2018-10-11
 */
namespace App\Service;



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
}

