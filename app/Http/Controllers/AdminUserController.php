<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminUserController extends BaseController
{
    //登陆
    public function login()
    {
        $info = request()->all();
        logger("loginInfo", $info);

        return $this->outPutSucc($info);
    }

    //注册
    public function register()
    {

    }

    //获取用户信息
    public  function  getAdminUserInfo()
    {

    }
}
