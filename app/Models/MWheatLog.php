<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class MWheatLog extends Model
{
    //
    use SoftDeletes;

    public $table = "m_wheat_log";

    protected $fillable = [
        'qrcode_id', 'admin_id', 'poster', 'steps', 'key_1', 'key_2', 'key_3', 'key_4', 'weather'
    ];

    public function adminUser()
    {
        return $this->belongsTo('App\Models\AdminUsers', 'admin_id');

        return $this->belongsTo('App\Models\AdminUsers', 'admin_id')->withDefault([
            'username' => "用户已被删除"
        ]);
    }

    public function qrcode()
    {
        // return $this->belongsTo('App\Models\MQrcodeInfo', 'qrcode_id');

        return $this->belongsTo( 'App\Models\MQrcodeInfo', 'qrcode_id')->withDefault(function ($qrcode) {
                $one = DB::table('m_qrcode_info')->find($this->qrcode_id);
                $qrcode->name = $one->name;
           });

        
    }
}
