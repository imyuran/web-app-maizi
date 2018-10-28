<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MQrcodeInfo as QrcodeInfo;
use App\Models\MExpressionInfo as ExpressionInfo;

class QrcodeController extends BaseController
{
    //获取二维码信息,并且返回第一个表现型
    public function getQrcodeByName()
    {
        $search = request('search');

        $list = QrcodeInfo::where("name", $search)->orWhere("unique_id", $search)->first();

        if($list) {
            $list->typeStr = config("maizi.type." . $list->type);

            $exp = ExpressionInfo::where("steps", 21)->get();

            $key_1 = [];
            foreach ($exp as &$item) {
                $key_1[] = $item->key_1;
            }
            $key_1 = array_unique($key_1);
            $new = [];
            $end = [];
            foreach ($key_1 as $k=>$v) {
                $new['value'] = $v;
                $new['text'] = $v;
                $end[] = $new;
            }

            $ret = [
                'qrcode' => $list,
                'expression' => $exp,
                'key_1' => $end
            ];


            return $this->outPutSucc($ret);
        } else {
            return $this->outPutErr("未查询到{$search}的信息！");
        }
    }
}
