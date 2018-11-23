<?php
/**
 * 商品管理-商品处理逻辑
 * date: 2018-10-19 
 */
namespace App\Http\Controllers\Goods;

use App\Http\Controllers\CommonController;
use App\Service\Goods\GoodsService;
use Illuminate\Http\Request;
use Validator;

class GoodsController extends CommonController
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
     * 商品列表
     * @return \Illuminate\Http\Response
     */
    public function getGoodsList(Request $request)
    {
        $view_data = $this->view_data;
        return GoodsService::CallFunc('getGoodsFilter')
            ->error(function($that){
                return view('errors.error', ['error'=>$that->getMessage()]);
            })->success(function($that) use ($view_data){
                $view_data = array_merge($view_data, $that->getData());
                return view('goods/goods_list', $view_data);
            })->getResponse();
    }

    /**
     * 获取商品单页-查看
     */
    public function ajaxGoodsList(Request $request)
    {
        $params = Validator::make($request->all(), [
            'category_id'=> 'integer',
            'author_id'  => 'integer',
            'title'      => 'string|max:250|default:',
        ])->validate();

        $view_data = $this->view_data;
        return GoodsService::CallFunc('getGoodsList', $params)
            ->error(function($that){
                return Response()->json($that);
            })->success(function($that) use ($view_data){
                $view_data = array_merge($view_data, $that->getData());
                $page = view('goods/ajax_list', $view_data);
                $part_html = response($page)->getContent();
                $that->setData($part_html);
                return $that->toJson();
            })->getResponse();
    }

    /**
     * 获取商品单页-添加
     */
    public function createGoodsPage(Request $request)
    {
        $this->setDetail([
            'item_name'  => '商品添加',
            'short_name' => 'createpage' 
        ]);
        $view_data = $this->view_data;
        return GoodsService::CallFunc('getGoodsDetailToCreate')
            ->error(function($that){
                return view('errors/error', ['error'=>$that->getMessage()]);
            })->success(function($that) use ($view_data){
                $view_data = array_merge($view_data, $that->getData());
                return view('goods/create_goods_page', $view_data);
            })->getResponse();
    }

    public function createGoods(Request $request)
    {
        $params = Validator::make($request->all(), [
            'category_id'=> 'integer',
            'model'      => 'string|max:240',
            'activity'   => 'string|max:200',
            'title'      => 'required|string|min:1|max:125',
            'content'    => 'required|string|min:1',
        ])->validate();

        return GoodsService::CallFunc('createGoods', $params, $this->_user_info)->toJson();
    }
    public function modifyGoodsPage(Request $request)
    {
        $this->setDetail([
            'item_name'  => '商品修改',
            'short_name' => 'modifypage' 
        ]);

        $params = Validator::make($request->all(), [
            'id'      => 'required|integer|min:1',
        ])->validate();

        $view_data = $this->view_data;
        return GoodsService::CallFunc('getGoodsDetailToModify', $params)
            ->error(function($that){
                return view('errors/error', ['error'=>$that->getMessage()]);
            })->success(function($that) use ($view_data){
                $view_data = array_merge($view_data, $that->getData());
                return view('goods/modify_goods_page', $view_data);
            })->getResponse();
    }
    public function modifyGoods(Request $request)
    {
        $params = Validator::make($request->all(), [
            'category_id'=> 'integer',
            'model'      => 'string|max:240',
            'activity'   => 'string|max:200',
            'id'         => 'required|integer|min:1',
            'title'      => 'required|string|min:1|max:125',
            'content'    => 'required|string|min:1',
        ])->validate();

        return GoodsService::CallFunc('modifyGoods', $params, $this->_user_info)->toJson();
    }
    public function deleteGoods(Request $request)
    {
        $params = Validator::make($request->all(), [
            'id'      => 'required|integer|min:1',
        ])->validate();

        return GoodsService::CallFunc('deleteGoods', $params, $this->_user_info)->toJson();
    }


}
