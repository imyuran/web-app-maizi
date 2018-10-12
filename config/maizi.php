<?php

return [

    "url" => [
      "getQrcodeInfo" => env('APP_URL', 'http://localhost') . "?unique_id=",
    ],
    "steps" => [
        21 => 'Feekes-8',
        22 => 'Feekes-10.1',
        23 => 'Feekes-10.5',
        24 => 'Feekes-11.2',
        25 => 'Seed',
    ],
    "type" => [
        4 => "四倍体",
        6 => "六倍体",
    ],
    "adminUserKey" => "AdminUserInfo",
    "qrcodeInfo" => "QrcodeInfo",
];
