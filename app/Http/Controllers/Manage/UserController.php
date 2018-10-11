<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;
use App\Service\Manage\UserService;

class UserController extends CommonController
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
//    public function userList(Request $request, UserService $user)
    public function userList(Request $request)
    {
//        dd(UserService::getInstance()->getUserList());
//        dd($user->getUserList());
        $users = UserService::getInstance()->getUserList();
        $data = [
            'view_data'=>$this->_view_data,
            'users' => $users,
        ];
        echo $users->links();
        exit;
        return view('manage/userlist', $data);
    }
}


