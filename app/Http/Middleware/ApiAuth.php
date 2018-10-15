<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Hash;
use App\Models\AdminUsers as AdminUsers;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //api每次访问，先登陆
        $username = $request->input("username");
        $password = $request->input("password");
        //$username要唯一，添加唯一索引
        $adminUser = AdminUsers::where('username', $username)->first();
        if($adminUser) {
            $pwd = Bcrypt($password);
            if( Hash::check($password, $adminUser->password) ) {
                return $next($request);
            } else {
//                return $this->outPutErr('用户名或密码错误！');
                //用户认证不通过，返回错误
            }
        }
//        return $next($request);
    }


}
