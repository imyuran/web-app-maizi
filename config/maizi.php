<?php

return [

    "url" => [
      "getQrcodeInfo" => env('APP_URL', 'http://localhost') . "?unique_id=",
    ],

    "type" => [
        4 => "四倍体",
        6 => "六倍体",
    ],
    "adminUserKey" => "AdminUserInfo"
];
