<?php
/**
 * 管理-用户逻辑
 * date: 2018-10-11
 */
namespace App\Service\Manage;

use App\Entity\User;
use App\Entity\City;
use App\Service\BaseService;


class UserService extends BaseService
{
    public function getUserList()
    {
        $users = User::paginate(config('view.per_page'));
//        $items = $users->items();
//        $city_ids = array_column($items, 'city_id');
//        $citys = City::whereIn('city_id', $city_ids)
//            ->get();
        return $users;
    }
}

