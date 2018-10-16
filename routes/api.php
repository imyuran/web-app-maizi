<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//登陆
Route::any('/login', "AdminUserController@login");
//注册
Route::any('/register', "AdminUserController@register");

//获取所有表现型
Route::any('/expression/getAllExpression', "ExpressionController@getAllExpression");
//添加新的表现型
Route::any('/expression/getAllExpression', "ExpressionController@getAllExpression");

//获取所有小麦日志
Route::any('/wheat/getAllWheatLog', "WheatController@getAllWheatLog");
//获取用户自己上传的所有小麦日志
Route::any('/wheat/getUserAllWheatLog', "WheatController@getUserAllWheatLog");
//上传新的小麦日志
Route::any('/wheat/addWheatLog', "WheatController@addWheatLog");
//编辑小麦日志
Route::any('/wheat/editWheatLog', "WheatController@editWheatLog");
//删除小麦日志
Route::any('/wheat/delWheatLog', "WheatController@delWheatLog");
