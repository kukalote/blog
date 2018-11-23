<?php

namespace App\Library;

use App\Exceptions\ModelExtraException;
use Illuminate\Database\Eloquent\Builder;

trait ModelTool
{
//    use ModelExtra;

    /**
     * 根据主键搜索数据
     */
    public static function getPrimary($query) 
    {
        var_dump($query->getModel()->getKeyName());exit;
    }

    /**
     * 根据主键搜索数据
     */
    public static function getCeilObj($query) 
    {
        return self::getQuery($query)->first();
    }

    /**
     * 根据主键搜索数据
     */
    public static function getCeilArr($query)
    {
        $data = self::getCeilObj($query);
        return !is_null($data)?$data->toArray():array();
    }

    /**
     * 根据主键搜索数据
     */
    public static function getListObj($query) 
    {
        return self::getQuery($query)->get();
    }

    public static function getListArr($query) 
    {
        $data = self::getListObj($query);
        return (!is_null($data) && !is_null($data->first())) ? $data->toArray() : array();
    }

    /**
     * 获取分页信息
     */
    public static function getListPage($query, $page=null) 
    {
        $page = $page??config('view.per_page');
        return self::getQuery($query)->paginate($page);
    }

    public static function getQuery($query)
    {
        if (!($query instanceof Builder)) {
            throw new ModelExtraException('SQL句柄异常');
        }
        return $query;
    }

}
