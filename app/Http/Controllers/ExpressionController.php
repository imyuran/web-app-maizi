<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MExpressionInfo as ExpressionInfo;

class ExpressionController extends BaseController
{
    //获取某一阶段所有表现型
    public function getAllExpressionBySteps()
    {
        $steps = request("steps", 21);

//        dump($steps);
        $list = ExpressionInfo::where("steps", $steps)->get();

        $key_1 = [];
        foreach ($list as &$item) {
            $key_1[] = $item->key_1;
        }

        $ret = [
            'expressions' => $list,
            'key_1' => array_unique($key_1)
        ];
        return $this->outPutSucc($ret);
    }


}
