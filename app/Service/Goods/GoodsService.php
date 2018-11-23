<?php
/**
 * 商品逻辑
 * date: 2018-11-15
 */
namespace App\Service\Goods;

use App\Entity\Goods;
//use App\Entity\GoodsCategory;
use App\Entity\GoodsContent;
use App\Entity\Result;
use App\Entity\User;
use App\Exceptions\CustomException;
use App\Service\BaseService;
use App\Service\Manage\UserService;
use DB;


class GoodsService extends BaseService
{
    /**
     * 获取树型可用菜单列表
     */
    public function getGoodsFilter()
    {
        // 作者
        $users = UserService::getInstance()->getUserList(['id', 'name', 'nick_name'], [['deleted', User::NO_DELETED]]);
        // 分类
        $categorys = GoodsCategoryService::getInstance()->selectGoodsCategoryList(['id', 'category']);
        return ['users'=>$users, 'categorys'=>$categorys];
    }
    /**
     * 获取树型可用菜单列表
     */
    public function getGoodsList($params)
    {
        $where = ['deleted'=>Goods::NO_DELETED];
        !empty($params['author_id'])   && $where[] = ['author_id', $params['author_id']];
        !empty($params['category_id']) && $where[] = ['category_id', $params['category_id']];
        !empty($params['title'])       && $where[] = ['title', 'like', "{$params['title']}%"];

        $list = $this->getGoodsPage($where);
        $categorys = GoodsCategoryService::getInstance()->selectGoodsCategoryList(['id', 'category']);
        return ['list'=>$list, 'categorys'=>$categorys];
    }

    /**
     * 创建商品
     */
    public function createGoods($params, $user_info)
    {
        $params['author_id']  = $user_info['id'];
        return $this->create($params);
    }

    /**
     * 获取商品详情
     */
    public function getGoodsDetailToCreate($params=null)
    {
        $goods_detail['categorys'] = GoodsCategoryService::getInstance()->selectGoodsCategoryList(['id', 'category']);
        return $goods_detail;
    }
    /**
     * 获取商品详情
     */
    public function getGoodsDetailToModify($params)
    {
        $goods_detail['detail'] = $this->getDetailPrimary($params['id']);
        $categorys = GoodsCategoryService::getInstance()->selectGoodsCategoryList(['id', 'category']);
        $goods_detail['categorys'] = array_column($categorys, null, 'id');
        return $goods_detail;
    }
     
    /**
     * 修改商品
     */
    public function modifyGoods($params, $user_info)
    {
        $params['author_id']  = $user_info['id'];
        return $this->modifyDetailPrimary($params['id'], $params);
    }

    /**
     * 删除商品信息
     */
    public function deleteGoods($params, $user_info)
    {
        $data = array();
        $goods_id = $params['id'];
        unset($params['id']);
        $data['author_id']  = $user_info['id'];
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['deleted']    = Goods::IS_DELETED;
        return $this->modifyPrimary($goods_id, $data);
    }



/**********************************************************************
*                                工具方法                                *
**********************************************************************/
    /**
     * 获取列表分页
     */
    public function getGoodsPage($where)
    {
        $query = Goods::where('deleted', Goods::NO_DELETED)->where($where);
        return Goods::getListPage($query);
    }
    public function getPrimary($goods_id)
    {
        $query = Goods::where('id', $goods_id);
        return Goods::getCeilArr($query);
    }

    public function getDetailPrimary($goods_id)
    {
        $goods = $this->getPrimary($goods_id);
        if (empty($goods)) {
            throw new CustomException('商品信息为空', Result::CODE_ERROR);
        }
        $content = $this->getGoodsContentPrimary(['*'], $goods['content_id']);
        if (empty($content)) {
            throw new CustomException('商品内容为空', Result::CODE_ERROR);
        }
        $goods['content'] = $content['content'];
        return $goods;
    }

    /**
     * 获取列表分页
     */
    public function getGoodsContentPrimary($fields, $content_id)
    {
        $query = GoodsContent::select($fields)->where('id', $content_id);
        return GoodsContent::getCeilArr($query);
    }

    /**
     * 插入内容
     */
    public function createGoodsContent($params)
    {
        return GoodsContent::insertGetId([
            'content' => $params['content'],
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * 修改商品内容
     */
    public function modifyContentPrimary($content_id, $content)
    {
        return GoodsContent::where('id', $content_id)->update([
            'content' => $content,
        ]);
    }

    /**
     * 插入文章
     */
    public function create(array $params)
    {
        $params['content_id'] = $this->createGoodsContent(['content'=>$params['content']]);

        if (empty($params['content_id'])) {
            throw new CustomException('内容插入失败', Result::CODE_ERROR);
        }

        return Goods::insert([
            'title'       => $params['title'],
            'category_id' => $params['category_id'],
            'model'       => $params['model'],
            'author_id'   => $params['author_id'],
            'content_id'  => $params['content_id'],
            'describe'    => '',
            'activity'    => $params['activity'],
            'discount'    => '',
            'price'       => 0,
            'deleted'     => Goods::NO_DELETED,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * 修改商品信息
     */
    public function modifyPrimary($goods_id, array $params)
    {
        return Goods::where('id', $goods_id)->update($params);
    }

    /**
     * 修改商品详情
     */
    public function modifyDetailPrimary($goods_id, array $params)
    {
        $goods = $this->getPrimary($goods_id);
        if (empty($goods)) {
            throw new CustomException('商品信息为空', Result::CODE_ERROR);
        }

        $effect_rows = $this->modifyContentPrimary($goods['content_id'], $params['content']);

        return Goods::where('id', $goods_id)->update([
            'title'       => $params['title'],
            'category_id' => $params['category_id'],
            'model'       => $params['model'],
            'author_id'   => $params['author_id'],
            'content_id'  => $goods['content_id'],
            'describe'    => '',
            'activity'    => $params['activity'],
            'discount'    => '',
            'price'       => 0,
            'deleted'     => Goods::NO_DELETED,
            'updated_at'  => date('Y-m-d H:i:s')
        ]);
    }


}
