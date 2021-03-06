<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MWheatLog as Wheat;
use App\Models\MExpressionInfo as ExpressionInfo;
use Illuminate\Support\Facades\Storage;

class WheatController extends BaseController
{
    //获取所有小麦日志
    public function getAllWheatLog()
    {
        $type = request("type", "down");
        $id   = request("id", 0);

        if($type == "down") {
            if($id > 0) {
                $list = Wheat::where("id", ">", $id)->limit(10)->get();
            } else {
                $list = Wheat::OrderBy("created_at", "desc")->limit(10)->get();
            }
        } else {
            $list = Wheat::where("id", "<", $id)->OrderBy("created_at", "desc")->limit(10)->get();
        }
        foreach ($list as &$item) {
            $item->qrcode_name = @$item->qrcode->name;
            $item->username    = @$item->adminUser->username;
            $item->steps_str   = array_get( config('maizi.steps'),$item->steps );
        }
//        dd($list->toArray());
        return $this->outPutSucc($list);

    }

    //获取用户自己上传的所有小麦日志
    public function getUserAllWheatLog()
    {
        //暂时没这个需求
    }

    //上传新的小麦日志
    public function addWheatLog()
    {
        $qrcode_id  = request("qrcode_id");
        $admin_id   = request("admin_id");
        $type       = request("type", 2);
        $image_flag = request("image_flag");


        $weather = request("weather");
        $steps = request("steps", 21);
        $key_1 = request("key_1");
        $key_2 = request("key_2","");
        $key_3 = request("key_3","");
        $key_4 = request("key_4", "");
       
        $data = [
            "qrcode_id" => $qrcode_id,
            "admin_id" => $admin_id,
            "weather" => $weather,
            "steps" => $steps,
            "key_1" => $key_1,
            "key_2" => $key_2,
            "key_3" => $key_3,
            "key_4" => $key_4,
        ];

        //图片上传
        if($image_flag) {
            $poster = request()->file('poster')->store('upload/posters');
            if(!$poster) {
                return $this->outPutErr('网络错误，删除失败！');
            }
            $data['poster'] = str_replace("upload","", $poster );
        }

        $ret = Wheat::create($data);

        if($ret) {
            return $this->outPutSucc($ret);
        } else {
            return $this->outPutErr('网络错误，保存失败！');
        }
    }

    //编辑小麦日志
    public function editWheatLog()
    {
        $id = request("id");
        $qrcode_id = request("qrcode_id");
        $admin_id = request("admin_id");
        //图片上传
        $qrcode_id = request("qrcode_id");

        $weather = request("weather");
        $steps = request("steps");
        $key_1 = request("key_1");
        $key_2 = request("key_2");
        $key_3 = request("key_3");
        $key_4 = request("key_4");

        $ret = Wheat::where(['id'=> $id])->first()->update([
            "qrcode_id" => $qrcode_id,
            "admin_id" => $admin_id,
            "weather" => $weather,
            "steps" => $steps,
            "key_1" => $key_1,
            "key_2" => $key_2,
            "key_3" => $key_3,
            "key_4" => $key_4,
        ]);

        if($ret) {
            return $this->outPutSucc($ret);
        } else {
            return $this->outPutErr('网络错误，保存失败！');
        }

    }

    //删除小麦日志
    public function delWheatLog()
    {
        $id = request("id");
        $admin_id = request("admin_id");


        $ret = Wheat::where(['id'=> $id])->first()->update([
            "admin_id" => $admin_id,
            "deleted_at" => now(),
        ]);

        if($ret) {
            return $this->outPutSucc($ret);
        } else {
            return $this->outPutErr('网络错误，删除失败！');
        }
    }

}
