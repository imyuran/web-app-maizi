<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    //
    public function outPutSucc($data = [], $headers = [])
    {
        $arr["error"] = 0;
        $arr["data"]  = $data;
        return response()->json($arr, 200, $headers);
    }

    public function outPutErr($msg = "", $headers = [])
    {
        $arr["error"] = 1;
        $arr["msg"]   = $msg;
        return response()->json($arr, 200, $headers);
    }
}
