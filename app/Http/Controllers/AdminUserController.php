<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\AdminUsers as AdminUsers;

class AdminUserController extends BaseController
{
    //登陆
    public function login()
    {
        $info = request()->all();
        logger("loginInfo", $info);
        $username = request("username");
        $password = request("password");
        //$username要唯一，添加唯一索引
        $adminUser = $this->getAdminUserInfo($username);
        if($adminUser) {
//            $pwd = Bcrypt($password);
            if( Hash::check($password, $adminUser->password) ) {
                return $this->outPutSucc($adminUser);
            } else {
                return $this->outPutErr('用户名或密码错误！');
            }
        }
        return $this->outPutErr('用户不存在！');
    }

    //注册
    public function register()
    {
        $username = request("username");
        $password = request("password");

        $adminUser = $this->getAdminUserInfo($username);
        if($adminUser) {
            return $this->outPutErr('用户名已存在！');
        }

        $ret = AdminUsers::created([
            'username' => $username,
            'name' => $username,
            'password' => Bcrypt($password),
            'avatar' => '/images/E.png',
        ]);

        if($ret) {
            return $this->outPutSucc($ret);
        } else {
            return $this->outPutErr('网络错误，注册失败！');
        }
    }

    //获取用户信息
    public  function  getAdminUserInfo($username)
    {
        return AdminUsers::where('username', $username)->first();
    }
}
