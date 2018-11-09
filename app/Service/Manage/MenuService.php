<?php
/**
 * 管理-菜单逻辑
 * date: 2018-10-11
 */
namespace App\Service\Manage;

use App\Entity\Result;
use App\Entity\Menu;
use App\Service\BaseService;
use App\Library\Tools;
use App\Exceptions\CustomJsonException;
use DB;


class MenuService extends BaseService
{
    /**
     * 获取树型可用菜单列表
     */
    public function getMenuList()
    {
        $menu_list = $this->getEnableMenuListArr();
        $menu_list = Tools::arrayToTree($menu_list, 'parent_id', 'id', 0, 'sort');
        return $menu_list;
    }

    /**
     * 获取单层树
     * @author xunyalong
     * @param  int	parent_id	父节点ID 
     * @return result
     */
    public function getTreeFloor($parent_id)
    {
        $menu_list = $this->getExtraTreeFloorArr($parent_id);
        return $this->_coverTreeSets($menu_list);
    }

    /**
     * create menu 
     */
    public function createMenu($data)
    {
        $result = new Result();
        // 创建新节点，将父节点改为文件夹类型
        $menu = $this->create($data);
        $this->modifyPrimary($data['parent_id'], ['type'=>Menu::FOLDER]);
        if ($menu) {
            $result->setCode(Result::CODE_SUCCESS)->setMsg('操作成功');
        } else {
            $result->setCode(Result::CODE_ERROR)->setMsg('操作失败');
        }
        return $result;
    }

    /**
     * 修改菜单
     * @author xunyalong
     * @param  array	$data	菜单信息 
     * @return bool
     */
    public function modifyMenu($id, $data)
    {
        return $this->modifyPrimary($id, $data);
    }

    /**
     * 删除菜单
     * @author xunyalong
     * @param  array	$data	菜单信息 
     * @return bool
     */
    public function deleteMenu($id)
    {
        $item = $this->getPrimary($id);
        $sbling_count = $this->getMenuFloorCount($item['parent_id']);
        if ($sbling_count==1) {
            $this->modifyPrimary($item['parent_id'], ['type'=>MENU::ITEM]);
        }
        return $this->deletePrimary($id);
    }

    /**
     * 转换为页面使用的数据集
     * @author xunyalong
     * @param  array	$data  菜单数据 
     * @return array
     */
    private function _coverTreeSets($data)
    {
        foreach ($data as $key=>$val) {
            $data[$key]['name']   = $val['item_name'];
            $data[$key]['type_n'] = $val['type'];
            $data[$key]['type']   = $val['type']==MENU::FOLDER ? 'folder' : 'item';
            $data[$key]['data']   = $data[$key];
        }
        return $data;
    }


/**********************************************************************
*                                工具方法                                *
**********************************************************************/
    /**
     * 获取可用菜单列表
     * 
     */
    public function getPrimary($id)
    {
        $query = Menu::where('id', $id)
            ->select(DB::raw('item_name, short_name, url, sort, parent_id, id'));
        return Menu::getCeilArr($query);
    }

    public function getMenuFloorCount($parent_id)
    {
        return Menu::where('parent_id', $parent_id)
            ->count();
    }



    /**
     * 获取可用菜单列表
     * 
     */
    public function getEnableMenuListArr()
    {
        $query = Menu::where('disabled', MENU::ENABLED)
            ->select(DB::raw('item_name, short_name, url, sort, parent_id, id'))
            ->orderBy('sort', 'asc');
        return Menu::getListArr($query);
    }

    /**
     * 获取指定树下层级
     * 
     */
    public function getExtraTreeFloorArr($parent_id){
        $query = Menu::where('disabled', MENU::ENABLED)
            ->where('parent_id', $parent_id)
            ->select(DB::raw('item_name, type, short_name, url, sort, parent_id, id, disabled'))
            ->orderBy('sort', 'asc');
        return Menu::getListArr($query);
    }

    /**
     * Create a new Menu 
     *
     * @param  array  $data
     * @return \App\Menu
     */
    public function create(array $data)
    {
        return Menu::insert([
            'item_name' => $data['item_name'],
            'short_name' => $data['short_name'],
            'parent_id' => $data['parent_id'],
            'url' => $data['url'],
            'sort' => $data['sort'],
            'disabled' => $data['disabled'],
            'other' => '',
        ]);
    }

    /**
     * delete the target Menu by id
     */
    public function deletePrimary($id)
    {
        $effect_rows = Menu::where('id', $id)->delete();
        return $effect_rows;
    }

    /**
     * modify the target Menu by id
     */
    public function modifyPrimary($id, $data)
    {
        $effect_rows = Menu::where('id', $id)->update($data);
        return $effect_rows;
    }
}

