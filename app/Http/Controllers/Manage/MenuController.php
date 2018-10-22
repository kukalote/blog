<?php
/**
 * 管理-菜单逻辑
 * date: 2018-10-19 
 */
namespace App\Service\Manage;

use App\Entity\City;
use App\Entity\Result;
use App\Entity\User;
use App\Service\BaseService;
use App\Exceptions\CustomJsonException;


class MenuService extends BaseService
{
    public function getMenuList()
    {
        $users = User::paginate(config('view.per_page'));
        return $users;
    }

    /**
     * create user
     */
    public function createUser($data)
    {
        $result = new Result();
        $user = $this->create($data);
        if ($user) {
            $result->setCode(Result::CODE_SUCCESS)->setMsg('操作成功');
        } else {
            $result->setCode(Result::CODE_ERROR)->setMsg('操作失败');
        }
        return $result;
    }
    /**
     * delete the target user by id
     */
    public function deleteUser($uid)
    {
        $result = new Result();
        $effect_rows = User::where('id', $uid)->delete();
        if ($effect_rows) {
            $result->setCode(Result::CODE_SUCCESS)->setMsg('操作成功');
        }
        return $result;
    }

    /**
     * edit the target user by id
     */
    public function modifyUser($uid, $data)
    {
        $result = new Result();
        $t = User::where('id', $uid)->update($data);
        $result->setCode(Result::CODE_SUCCESS)->setMsg('操作成功');
        return $result;
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'aaa' => '',
            'name' => $data['name'],
            'nick_name' => $data['nick_name'],
            'email' => $data['email'],
            'city_id' => $data['city_id'],
            'password' => Hash::make($data['password']),
        ]);
    }
}

