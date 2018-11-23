<?php
/**
 * 商品管理-商品种类逻辑
 * date: 2018-11-22
 */
namespace App\Http\Controllers\Goods;

use App\Http\Controllers\CommonController;
use App\Service\Goods\GoodsService;
use App\Service\Goods\GoodsCategoryService;
use Illuminate\Http\Request;
use Validator;

class GoodsCategoryController extends CommonController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    /**
     * 获取种类列表
     */
    public function getCategoryList(Request $request)
    {
        $view_data = $this->view_data;
        return GoodsCategoryService::CallFunc('getCategoryFilter')
            ->error(function($that){
                return view('errors.error', ['error'=>$that->getMessage()]);
            })->success(function($that) use ($view_data){
                $view_data = array_merge($view_data, $that->getData());
                return view('goods/goods_category_list', $view_data);
            })->getResponse();
    }

    /**
     * 获取商品单页-查看
     */
    public function ajaxCategoryList(Request $request)
    {
        $params = Validator::make($request->all(), [
//            'category'=> 'required|string|min:1|max:90',
        ])->validate();

        $view_data = $this->view_data;
        return GoodsCategoryService::CallFunc('getCategoryList', $params)
            ->error(function($that){
                return $that->toJson();
            })->success(function($that) {
                $view_data = $that->getData();
                $page = view('goods/ajax_category_list', $view_data);
                $part_html = response($page)->getContent();
                $that->setData($part_html);
                return $that->toJson();
            })->getResponse();
    }

    /**
     * 创建种类
     */
    public function createCategory(Request $request)
    {
        $params = Validator::make($request->all(), [
            'category'=> 'required|string|min:1|max:90',
        ])->validate();
        return GoodsCategoryService::CallFunc('createCategory', $params, $this->_user_info)->toJson();
    }

    /**
     * 修改种类
     */
    public function modifyCategory(Request $request)
    {
        $params = Validator::make($request->all(), [
            'id'         => 'required|integer|min:1',
            'category'   => 'required|string|min:1|max:90',
        ])->validate();

        return GoodsCategoryService::CallFunc('modifyCategory', $params, $this->_user_info)->toJson();
    }
    
    /**
     * 删除种类
     */
    public function deleteCategory(Request $request)
    {
        $params = Validator::make($request->all(), [
            'id'         => 'required|integer|min:1',
        ])->validate();

        return GoodsCategoryService::CallFunc('deleteCategory', $params, $this->_user_info)->toJson();
    }
}
