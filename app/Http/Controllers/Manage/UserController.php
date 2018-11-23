<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\CommonController;
use App\Service\Manage\UserService;
use App\Entity\Result;
use Exception;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class UserController extends CommonController
{


    use RegistersUsers;
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
    public function getUserList(Request $request)
    {
        $users = UserService::getInstance()->getUserPage();
        $data = [
            'view_data'=>$this->_view_data,
            'users' => $users,
        ];
        return view('manage/userlist', $data);
    }


    /**
     * create the target user.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'city_id' => 'required|integer',
            'nick_name' => '',
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $data = $validator->validate();

        $result = UserService::getInstance()->createUser($data);
        return response()->json($result->toArray());
    }


    /**
     * delete the target user.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteUser(Request $request)
    {
        $uid = $request->input('uid');
        $result = UserService::getInstance()->deleteUser($uid);
        return response()->json($result->toArray());
    }


    /**
     * edit the target user.
     *
     * @return \Illuminate\Http\Response
     */
    public function editUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uid' => 'required|integer|min:1',
            'city_id' => 'required|integer',
            'nick_name' => '',
            'name' => [
                'required',
                'string',
                'max:30',
                'min:2',
                Rule::unique('users')->ignore($request['uid'])
            ],
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users')->ignore($request['uid'])
            ],
        ]);
        $data = $validator->validate();
        $uid = $data['uid'];
        unset($data['uid']);

        $result = UserService::getInstance()->modifyUser($uid, $data);
        return response()->json($result->toArray());
    }
}


