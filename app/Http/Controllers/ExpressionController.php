<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MExpressionInfo as ExpressionInfo;

class ExpressionController extends BaseController
{
    //获取下一阶段所有表现型
    public function getNextExpression()
    {
        $steps = request("steps", 21);
        $select = request("select", '');

        $key_1 = request("key_1", '');
        $key_2 = request("key_2", '');
        $key_3 = request("key_3", '');

        $where = [
            ['steps' ,$steps]
        ];
        if($key_1) {
            $where[] = ['key_1', $key_1];
        }
        if($key_2) {
            $where[] = ['key_2', $key_2];
        }
        if($key_3) {
            $where[] = ['key_3', $key_3];
        }


        $list = ExpressionInfo::getNextExpression($where, $select);

        $new = [];
        $end = [];
        if( !$list->isEmpty() ) {
            foreach ($list as $v) {
                $new['value'] = $v->$select;
                $new['text'] = $v->$select;
                $end[] = $new;
            }
        }

        return $this->outPutSucc( $end );
    }


}
