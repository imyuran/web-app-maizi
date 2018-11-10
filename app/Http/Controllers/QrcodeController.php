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

            $where = [
                ["steps", 21]
            ];
            $key_1 = ExpressionInfo::getNextExpression($where, "key_1");

            $new = [];
            $end = [];
            foreach ($key_1 as $v) {
                $new['value'] = $v->key_1;
                $new['text'] = $v->key_1;
                $end[] = $new;
            }

            $ret = [
                'qrcode' => $list,
                'key_1'  => $end,
                'time'   => date("Y-m-d H:i", time())
            ];


            return $this->outPutSucc($ret);
        } else {
            return $this->outPutErr("未查询到{$search}的信息！");
        }
    }
}
