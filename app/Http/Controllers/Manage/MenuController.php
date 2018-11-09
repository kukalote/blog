<?php
/**
 * 管理-菜单逻辑
 * date: 2018-10-19 
 */
namespace App\Http\Controllers\Manage;

use App\Http\Controllers\CommonController;
use App\Service\Manage\MenuService;
use App\Entity\Result;
use Exception;
//use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class MenuController extends CommonController
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
     * Show the user list.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMenuList(Request $request)
    {
        $data = [
            'view_data'=>$this->_view_data,
        ];
        return view('manage/menulist', $data);
    }

    /**
     * 获取某节点下一层目录树
     *
     * @return \Illuminate\Http\Response
     */
    public function getMenuTree(Request $request)
    {
        $parent_id = $request->input('parent_id', 0);
        $result = MenuService::CallFunc('getTreeFloor', $parent_id);
        return response()->json($result->toArray());
    }


    /**
     * create the target menu.
     * 创建一个新节点
     *
     * @return \Illuminate\Http\Response
     */
    public function createMenu(Request $request)
    {
        $data = Validator::make($request->all(), [
            'item_name'  => 'required|string|max:20',
            'short_name' => 'required|string|max:30',
            'parent_id'  => 'required|integer|exists:menu,id',
            'sort' => 'integer|default:0',
            'url' => 'string|max:250|default:""',
            'disabled' => 'boolean|default:0',
//            'other' => 'default:""',
        ])->validate();

        $result = MenuService::CallFunc('createMenu', $data);
        return response()->json($result->toArray());
    }

    /**
     * modify the target menu.
     * 修改一个节点
     *
     * @return \Illuminate\Http\Response
     */
    public function modifyMenu(Request $request)
    {
        $data = Validator::make($request->all(), [
            'id'         => 'required|integer|min:1|exists:menu,id',
            'item_name'  => 'required|string|max:20',
            'short_name' => 'required|string|max:30',
            'parent_id'  => 'required|integer',
            'sort'       => 'integer|default:0',
            'url'        => 'string|max:250|default:""',
            'disabled'   => 'boolean|default:0',
        ])->validate();

        $result = MenuService::CallFunc('modifyMenu', $id, $data);
        return response()->json($result->toArray());
    }

    /**
     * delete the target menu.
     * 创建一个新节点
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteMenu(Request $request)
    {
        $data = Validator::make($request->all(), [
            'id' => 'required|integer|min:1',
        ])->validate();

        $result = MenuService::CallFunc('deleteMenu', $data['id']);
        return response()->json($result->toArray());
    }

}


