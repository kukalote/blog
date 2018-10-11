<?php
/**
 * 管理-用户逻辑
 * date: 2018-10-11
 */
namespace App\Service\Manage;

use App\Entity\User;
use App\Service\BaseService;


class UserService extends BaseService
{
    public function getUserList()
    {
        $user_list = User::paginate(config('view.per_page'));
        return $user_list;
    }
}

