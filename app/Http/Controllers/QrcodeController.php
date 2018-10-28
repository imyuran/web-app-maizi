<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MQrcodeInfo as QrcodeInfo;

class QrcodeController extends BaseController
{
    //获取二维码信息
    public function getQrcodeByName()
    {
        $search = request('search');

        $ret = QrcodeInfo::where("name", $search)->orWhere("unique_id", $search)->first();

        if($ret) {
            $ret->typeStr = config("maizi.type." . $ret->type);
            return $this->outPutSucc($ret);
        } else {
            return $this->outPutErr("未查询到{$search}的信息！");
        }
    }
}
