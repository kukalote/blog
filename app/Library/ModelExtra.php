<?php

namespace App\Library;

use App\Entity\Result;
use App\Exceptions\ModelExtraException;
use Illuminate\Database\Eloquent\Builder;

/**
 * 数据表操作模块
 * @author  xunyalong
 * @date    2018-06-08
 */
exit;
trait ModelExtra
{
    private static $EntityPath = 'App\Entity';
    private static $EntitySeparator = '.';

    /**
     * 获取数据列表-page
     * @author xunyalong
     * @param  string	$table_entity	表实例化名称 
     * @param  string/array    $fields	    字段列表 
     * @param  array    $filters	    过滤列表 
     * @param  array    $order	        排序列表 
     * @param  array    $options	    其他选项：onWrite是否主库
     * @param  int      $perpage	    每页显示条数
     * @return object;
     */
//    public static function getEntityPages ( $table_entity, $fields, $filters=[], $order=[], $options=[], $perpage = 15 )
//    {
//        $result = new Result();
//        try{
//            $query = $this->_makeTableEntity( $table_entity );
//            $query = $this->_buildCommonQuery ( $query, $fields, $filters, $order, $options );
//            //print_r($query->toSql());
//            $page_data = $query->paginate($perpage );
//            $result->setMsg( '操作成功' )->setCode( Result::CODE_SUCCESS )->setData( $page_data );
//        } catch ( ModelExtraException $e) {
//            $msg = ( $e->getCode()==Result::CODE_ERROR )?$e->getMessage():'系统异常';
//            $msg = $e->getMessage();
//            $result->setMsg( $msg )->setCode( Result::CODE_ERROR );
//        }
//        return $result;
//    }

    /**
     * 获取数据列表
     * @author xunyalong
     * @param  string	$table_entity	表实例化名称 
     * @param  string/array    $fields	    字段列表 
     * @param  array    $filters	    过滤列表 
     * @param  array    $order	        排序列表 
     * @param  array    $options	    其他选项：onWrite是否主库
     * @return array;
     */
//    public static function getEntityList ( $table_entity, $fields, $filters=[], $order=[], $options=[] )
//    {
//        $result = new Result();
//        try{
//            $query = $this->_makeTableEntity( $table_entity );
//            $query = $this->_buildCommonQuery ( $query, $fields, $filters, $order, $options );
//            $data = $query->get();
//            if( empty($data) || !$data->first() ) {
//                $arr = [];
//            } else {
//                $arr = $data->toArray();
//            }
//            $result->setMsg( '操作成功' )->setCode( Result::CODE_SUCCESS )->setData( $arr );
//        } catch ( ModelExtraException $e) {
//            $msg = ( $e->getCode()==Result::CODE_ERROR )?$e->getMessage():'系统异常';
//            $msg = $e->getMessage();
//            $result->setMsg( $msg )->setCode( Result::CODE_ERROR );
//        }
//        return $result;
//    }


    /**
     * 获取数据片段(部分数据)-array
     * @author xunyalong
     * @param  string	$table_entity	表实例化名称 
     * @param  string/array    $fields	    字段列表 
     * @param  array    $filters	    过滤列表 
     * @param  array    $order	        排序列表 
     * @param  int      $limit	        查询条数
     * @param  int      $offset	        查询偏移量
     * @param  array    $options	    其他选项：onWrite是否主库
     * @return array;
     */
//    public static function getEntityFragment ( $table_entity, $fields, $filters=[], $order=[], $limit = 10, $offset = 0, $options=[] )
//    {
//        $result = new Result();
//        try{
//            if( empty($limit) ) {
//                throw new ModelExtraException( '获取数据条数不得空', Result::CODE_ERROR );
//            }
//            $query = $this->_makeTableEntity( $table_entity );
//            $query = $this->_buildCommonQuery ( $query, $fields, $filters, $order, $options );
//            $fragment_data = $query->offset($offset)->limit($limit)->get();
//
//            if( !empty($fragment_data) && $fragment_data->first() ) {
//                $fragment_arr = $fragment_data->toArray();
//            } else {
//                $fragment_arr = array();
//            }
//            $result->setMsg( '操作成功' )->setCode( Result::CODE_SUCCESS )->setData( $fragment_arr );
//        } catch ( ModelExtraException $e) {
//            $msg = ( $e->getCode()==Result::CODE_ERROR )?$e->getMessage():'系统异常';
//            $msg = $e->getMessage();
//            $result->setMsg( $msg )->setCode( Result::CODE_ERROR );
//        }
//        return $result;
//    }



    /**
     * 获取数据数量
     * @author xunyalong
     * @param  string	$table_entity	表实例化名称 
     * @param  array    $filters	    过滤列表 
     * @param  array    $options	    其他选项：onWrite是否主库
     * @return object;
     */
//    public static function getEntityCount ( $table_entity, $filters=[], $options=[] )
//    {
//        $result = new Result();
//        try{
//            $query = $this->_makeTableEntity( $table_entity );
//            $query = $this->_buildCommonQuery ( $query, [], $filters, [], $options );
//            $data = $query->count();
//            $result->setMsg( '操作成功' )->setCode( Result::CODE_SUCCESS )->setData( $data );
//        } catch ( ModelExtraException $e) {
//            $msg = ( $e->getCode()==Result::CODE_ERROR )?$e->getMessage():'系统异常';
//            $msg = $e->getMessage();
//            $result->setMsg( $msg )->setCode( Result::CODE_ERROR );
//        }
//        return $result;
//    }


    /**
     * 获取数据-first
     * @author xunyalong
     * @param  string	$table_entity	表实例化名称 
     * @param  string/array    $fields	    字段列表 
     * @param  array    $filters	    过滤列表 
     * @param  array    $order	        排序列表 
     * @param  array    $options	    其他选项：onWrite是否主库
     * @return object;
     */
//    public static function getEntityFirst ( $table_entity, $fields, $filters=[], $order=[], $options=[] )
//    {
//        $result = new Result();
//        try{
//            $query = $this->_makeTableEntity( $table_entity );
//            $query = $this->_buildCommonQuery ( $query, $fields, $filters, $order, $options );
//            $data = $query->first();
//            $result->setMsg( '操作成功' )->setCode( Result::CODE_SUCCESS )->setData( $data );
//        } catch ( ModelExtraException $e) {
//            $msg = ( $e->getCode()==Result::CODE_ERROR )?$e->getMessage():'系统异常';
//            $msg = $e->getMessage();
//            $result->setMsg( $msg )->setCode( Result::CODE_ERROR );
//        }
//        return $result;
//    }


    /**
     * 修改数据-单条
     * @author xunyalong
     * @param  string	$table_entity	表实例化名称 
     * @param  array    $data	        修改数据
     *      'column' => DB::raw('column+1')     //字段+1操作
     * @param  array    $filters	    过滤列表 
     * @param  array    $order	        排序列表 
     * @param  array    $options	    其他选项：onWrite是否主库
     * @return object;
     */
//    public static function modifyEntityFirst ( $table_entity, $data, $filters=[], $order=[], $options=[] )
//    {
//        $result = new Result();
//        try{
//            $query = $this->_makeTableEntity( $table_entity );
//            $query = $this->_buildCommonQuery ( $query, [], $filters, $order, $options );
//            $data = $query->limit(1)->update( $data );  // 只修改一条
//            $result->setMsg( '操作成功' )->setCode( Result::CODE_SUCCESS )->setData( $data );
//        } catch ( ModelExtraException $e) {
//            $msg = ( $e->getCode()==Result::CODE_ERROR )?$e->getMessage():'系统异常';
//            $msg = $e->getMessage();
//            $result->setMsg( $msg )->setCode( Result::CODE_ERROR );
//        }
//        return $result;
//    }

    /**
     * 修改数据-所有
     * @author xunyalong
     * @param  string	$table_entity	表实例化名称 
     * @param  array    $data	        修改数据
     *      'column' => DB::raw('column+1')     //字段+1操作
     * @param  array    $filters	    过滤列表 
     * @param  array    $options	    其他选项：onWrite是否主库
     * @return object;
     */
//    public static function modifyEntityAll ( $table_entity, $data, $filters=[], $options=[] )
//    {
//        $result = new Result();
//        try{
//            $query = $this->_makeTableEntity( $table_entity );
//            $query = $this->_buildCommonQuery ( $query, [], $filters, $options );
//            $data = $query->update( $data );
//            $result->setMsg( '操作成功' )->setCode( Result::CODE_SUCCESS )->setData( $data );
//        } catch ( ModelExtraException $e) {
//            $msg = ( $e->getCode()==Result::CODE_ERROR )?$e->getMessage():'系统异常';
//            $msg = $e->getMessage();
//            $result->setMsg( $msg )->setCode( Result::CODE_ERROR );
//        }
//        return $result;
//    }


    /**
     * 插入数据
     * @author xunyalong
     * @param  string	$table_entity	表实例化名称 
     * @param  array    $data	        修改数据
     * @param  array    $options	    其他选项：onWrite是否主库
     * @return object;
     */
//    public static function addEntityData ( $table_entity, $data, $options=[] )
//    {
//        $result = new Result();
//        try{
//            $query = $this->_makeTableEntity( $table_entity );
//            $query = $this->_buildCommonQuery ( $query, [], [], [], $options );
//            $data = $query->insert( $data );
//            $result->setMsg( '操作成功' )->setCode( Result::CODE_SUCCESS )->setData( $data );
//        } catch ( ModelExtraException $e) {
//            $msg = ( $e->getCode()==Result::CODE_ERROR )?$e->getMessage():'系统异常';
//            $msg = $e->getMessage();
//            $result->setMsg( $msg )->setCode( Result::CODE_ERROR );
//        }
//        return $result;
//    }

    /**
     * 删除数据-一条
     * @author xunyalong
     * @param  string	$table_entity	表实例化名称 
     * @param  array    $data	        修改数据
     * @param  array    $filters	    过滤列表 
     * @param  array    $order	        排序列表 
     * @param  array    $options	    其他选项：onWrite是否主库
     * @return object;
     */
//    public static function delEntityFirst ( $table_entity, $filters=[], $order=[], $options=[] )
//    {
//        $result = new Result();
//        try{
//            $query = $this->_makeTableEntity( $table_entity );
//            $query = $this->_buildCommonQuery ( $query, [], $filters, $order, $options );
//            $data = $query->limit(1)->delete();
//            $result->setMsg( '操作成功' )->setCode( Result::CODE_SUCCESS )->setData( $data );
//        } catch ( ModelExtraException $e) {
//            $msg = ( $e->getCode()==Result::CODE_ERROR )?$e->getMessage():'系统异常';
//            $msg = $e->getMessage();
//            $result->setMsg( $msg )->setCode( Result::CODE_ERROR );
//        }
//        return $result;
//    }


    /**
     * 删除数据-所有匹配项
     * @author xunyalong
     * @param  string	$table_entity	表实例化名称 
     * @param  array    $data	        修改数据
     * @param  array    $filters	    过滤列表 
     * @param  array    $order	        排序列表 
     * @param  array    $options	    其他选项：onWrite是否主库
     * @return object;
     */
//    public static function delEntityAll ( $table_entity, $filters=[], $order=[], $options=[] )
//    {
//        $result = new Result();
//        try{
//            $query = $this->_makeTableEntity( $table_entity );
//            $query = $this->_buildCommonQuery ( $query, [], $filters, $order, $options );
//            $data = $query->delete();
//            $result->setMsg( '操作成功' )->setCode( Result::CODE_SUCCESS )->setData( $data );
//        } catch ( ModelExtraException $e) {
//            $msg = ( $e->getCode()==Result::CODE_ERROR )?$e->getMessage():'系统异常';
//            $msg = $e->getMessage();
//            $result->setMsg( $msg )->setCode( Result::CODE_ERROR );
//        }
//        return $result;
//    }



    /**
     * 获取过滤器句柄
     * @author xunyalong
     * @param  string	$table_entity	表实例化名称 
     * @param  string/array    $fields	    字段列表 
     * @param  array    $filters	    过滤列表 
     * @param  array    $order	        排序列表 
     * @param  array    $options	    其他选项：onWrite是否主库
     * @return object;
     */
//    public static function getEntityHandle ( $table_entity, $fields, $filters=[], $order=[], $options=[] )
//    {
//        $result = new Result();
//        try{
//            $query = $this->_makeTableEntity( $table_entity );
//            $query = $this->_buildCommonQuery ( $query, $fields, $filters, $order, $options );
//            $data = $query;
//            $result->setMsg( '操作成功' )->setCode( Result::CODE_SUCCESS )->setData( $data );
//        } catch ( ModelExtraException $e) {
//            $msg = ( $e->getCode()==Result::CODE_ERROR )?$e->getMessage():'系统异常';
//            $msg = $e->getMessage();
//            $result->setMsg( $msg )->setCode( Result::CODE_ERROR );
//        }
//        return $result;
//    }


    /**
     * 生成查询实例
     * @author xunyalong
     * @param  string	$table_entity	数据表实例名称(含子路径:例[CctvData.Monitor]) 
     * @return object
     */
    private static function _makeTableEntity ( $table_entity )
    {
        if( strpos($table_entity, self::$EntitySeparator ) !== false ) {
            $table_entity = str_replace( self::$EntitySeparator, '\\', $table_entity );
        }

        $table_entity = self::$EntityPath.'\\'.$table_entity;
        if( !class_exists( $table_entity ) ) {
            throw new ModelExtraException( "请检测实例 {$table_entity} 是否存在", Result::CODE_ERROR );
        }
        return $table_entity::query();
    }

    /**
     * 数据实例查询句柄
     * @author xunyalong
     * @param  string/array    $fields	    字段列表 
     * @param  array    $filters	过滤列表 
     * @param  array    $order	    排序列表 
     * @param  array    $options	其他选项：onWrite是否主库
     * 
     * $filters = [
     *  'column' => 'xyz',                  // 默认and匹配
     *  'in' => ['column'=>[1,2,3]],        // 范围匹配
     *  'like' => ['column'=>'xyz'],        // 模糊匹配
     *  'orLike' => ['column'=>'xyz'],        // Or模糊匹配
     *  'between' => ['column'=>[1,100]],   // 区间匹配
     *  'or' => ['column'=>'1'],    // 或匹配
     *  'gt' => ['column'=>'1'],    // 大于匹配
     *  'ge' => ['column'=>'1'],    // 大于等于匹配
     *  'lt' => ['column'=>'1'],    // 小于匹配
     *  'le' => ['column'=>'1'],    // 小于等于匹配
     *  'ne' => ['column'=>'1'],    // 不等于匹配
     *  'subQuery' => [             // and 括号匹配
     *      [
     *          'cityid' => 913,
     *      ],  
     *      [
     *          'masterid' => 913,
     *      ],
     *  ],  
     *  'orSubQuery' => [           // or 括号匹配
     *      [
     *          'cityid' => 913,
     *      ]
     *  ],  
     *  'groupBy' => [
     *      'column',
     *  ],
     * ]
     * $order = [
     *  'order' => 'desc',
     * ]
     * $options = ['onWrite'=> bool]
     * @return query
     */
    private static function _buildCommonQuery ( &$query, $fields=[], $filters=[], $order=[], $options=[] )
    {
        if( !$query instanceof Builder ) {
            throw new \Exception( '非法SQL句柄', Result::CODE_ERROR );
        }

        if( !empty($options['onWrite']) ) {
            $query = $query->useWritePdo();
        } 

        if( !empty( $fields ) ) {
            if( is_string($fields) ) {
                $query->selectRaw( $fields );
            } else {
                $query->select( $fields );
            }
        }

        if( !empty( $order ) ) {
            if( !empty($order['orderByRaw']) ) {
                $query->orderByRaw( $order['orderByRaw'] );
            }else {
                foreach( $order as $column => $direction ) {
                    $query->orderBy( $column, $direction );
                }
            } 
        }

        if( !empty($filters['or']) && is_array($filters['or']) ) {
            foreach( $filters['or'] as $column => $filter ) {
                $query->orWhere( $column, $filter );
            }
            unset( $filters['or'] );
        }

        if( !empty($filters['in']) && is_array($filters['in']) ) {
            foreach( $filters['in'] as $column => $filter ) {
                $query->whereIn( $column, $filter );
            }
            unset( $filters['in'] );
        }

        if( !empty($filters['between']) && is_array($filters['between']) ) {
            foreach( $filters['between'] as $column => $filter ) {
                $query->whereBetween( $column, [$filter[0], $filter[1]] );
            }
            unset( $filters['between'] );
        }

        if( !empty($filters['like']) && is_array($filters['like']) ) {
            foreach( $filters['like'] as $column => $filter ) {
                $query->where( $column, 'like', "{$filter}%" );
            }
            unset( $filters['like'] );
        }

        if( !empty($filters['fullLike']) && is_array($filters['fullLike']) ) {
            foreach( $filters['fullLike'] as $column => $filter ) {
                $query->where( $column, 'like', "%{$filter}%" );
            }
            unset( $filters['fullLike'] );
        }

        if( !empty($filters['orLike']) && is_array($filters['orLike']) ) {
            foreach( $filters['orLike'] as $column => $filter ) {
                $query->orWhere( $column, 'like', "{$filter}%" );
            }
            unset( $filters['orLike'] );
        }

        if( !empty($filters['orFullLike']) && is_array($filters['orFullLike']) ) {
            foreach( $filters['orFullLike'] as $column => $filter ) {
                $query->orWhere( $column, 'like', "%{$filter}%" );
            }
            unset( $filters['orFullLike'] );
        }

        if( !empty($filters['gt']) && is_array($filters['gt']) ) {
            foreach( $filters['gt'] as $column => $filter ) {
                $query->where( $column, '>', $filter );
            }
            unset( $filters['gt'] );
        }

        if( !empty($filters['ge']) && is_array($filters['ge']) ) {
            foreach( $filters['ge'] as $column => $filter ) {
                $query->where( $column, '>=', $filter );
            }
            unset( $filters['ge'] );
        }

        if( !empty($filters['lt']) && is_array($filters['lt']) ) {
            foreach( $filters['lt'] as $column => $filter ) {
                $query->where( $column, '<', $filter );
            }
            unset( $filters['lt'] );
        }

        if( !empty($filters['le']) && is_array($filters['le']) ) {
            foreach( $filters['le'] as $column => $filter ) {
                $query->where( $column, '<=', $filter );
            }
            unset( $filters['le'] );
        }

        if( !empty($filters['ne']) && is_array($filters['ne']) ) {
            foreach( $filters['ne'] as $column => $filter ) {
                $query->where( $column, '!=', $filter );
            }
            unset( $filters['ne'] );
        }

        if( !empty($filters['subQuery']) && is_array($filters['subQuery']) ) {
            $instance = $this;
            foreach( $filters['subQuery'] as $column => $filter ) {
                $query->where(function($query)use($filter, $instance){
                    $instance->_buildCommonQuery ( $query, [], $filter );
                });
            }
            unset( $filters['subQuery'] );
        }

        if( !empty($filters['orSubQuery']) && is_array($filters['orSubQuery']) ) {
            $instance = $this;
            foreach( $filters['orSubQuery'] as $column => $filter ) {
                $query->orWhere(function($query)use($filter, $instance){
                    $instance->_buildCommonQuery ( $query, [], $filter );
                });
            }
            unset( $filters['orSubQuery'] );
        }

        if( !empty($filters['groupBy']) && is_array($filters['groupBy']) ) {
            foreach( $filters['groupBy'] as $filter ) {
                $query->groupBy( $filter );
            }
            unset( $filters['groupBy'] );
        }

        foreach( $filters as $column => $filter ) {
            $query->where( $column, $filter );
        }

        return $query;
    }
}

class MQuery
{
    public function __construct($model)
    {
        $this->_primary = $model;
    }
}
