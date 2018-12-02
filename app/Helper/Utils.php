<?php
/**
 * Created by PhpStorm.
 * User: 83697
 * Date: 2018/10/11
 * Time: 20:50
 */

namespace App\Helper;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Utils
{
    public static function createQrcode ( $code, $to_url) {

        $qrcode_name = 'qrcodes/'. date("Y_m_d-H_i_s-") . $code . '.png';
        $contents = \QrCode::format('png')
            ->size(100)
            ->margin(.5)
            ->generate($to_url.$code);
            // ->generate($to_url.$code ,public_path( 'upload/' . $qrcode_name));


        //上传到阿里云
        Storage::put($qrcode_name, $contents); 
        return $qrcode_name;
    }

    public static function getAdminInfoById ($id)
    {
        $key = config('maizi.adminUserKey').'_'.$id;
        return Cache::remember( $key, 10, function() use($id){
            return DB::table('admin_users')->find($id);
        });
    }

    public static function getAdminNameById ($id)
    {
        return self::getAdminInfoById($id)->name;
    }


    public static function getQrcodeInfoById ($id)
    {
        $key = config('maizi.qrcodeInfo').'_'.$id;
        return Cache::remember( $key, 10, function() use($id){
            return DB::table('m_qrcode_info')->find($id);
        });
    }

    public static function getQrcodeNameById ($id)
    {
        return self::getQrcodeInfoById($id)->name;
    }
}