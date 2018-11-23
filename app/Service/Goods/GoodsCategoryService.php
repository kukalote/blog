<?php
/**
 * 商品种类逻辑
 * date: 2018-11-21
 */
namespace App\Service\Goods;

use App\Entity\GoodsCategory;
use App\Entity\Result;
use App\Exceptions\CustomException;
use App\Service\BaseService;
use DB;


class GoodsCategoryService extends BaseService
{

    /**
     * 商品种类过滤栏数据
     */
    public function getCategoryFilter(array $params=[])
    {
        return array();    
    }

    /**
     * 获种类列表
     */
    public function getCategoryList(array $params)
    {
        $list = $this->selectGoodsCategoryPage(['id', 'category'], [['deleted', GoodsCategory::NO_DELETED]]);
        return ['list' => $list];
    }

    /**
     * 创建种类
     */
    public function createCategory(array $params, $user_info)
    {
        return $this->insertGoodsCategory($params, $user_info);
    }

    /**
     * 修改种类
     */
    public function modifyCategory(array $params, $user_info)
    {
        $data = [
            'category' => $params['category'],
        ];
        return $this->updateGoodsCategoryPrimary($params['id'], $data);
    }

    /**
     * 删除种类
     */
    public function deleteCategory(array $params, $user_info)
    {
        $data = [
            'deleted' => GoodsCategory::IS_DELETED,
        ];
        return $this->updateGoodsCategoryPrimary($params['id'], $data);
    }

/**********************************************************************
*                                查询方法                                *
**********************************************************************/


    /**
     * 获取列表-全部
     */
    public function selectGoodsCategoryList($fields, $where=[])
    {
        $query = GoodsCategory::select($fields)->where($where);
        return GoodsCategory::getListArr($query);
    }
    /**
     * 获取列表分页
     */
    public function selectGoodsCategoryPage($fields, $where=[])
    {
        $query = GoodsCategory::select($fields)->where($where);
        return GoodsCategory::getListPage($query);
    }


    /**
     * 插入种类
     */
    public function insertGoodsCategory($params, $user_info)
    {
        return GoodsCategory::insertGetId([
            'category' => $params['category'],
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * 修改种类
     */
    public function updateGoodsCategoryPrimary($id, $params)
    {
        return GoodsCategory::where('id', $id)
            ->update($params);
    }
}
