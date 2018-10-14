<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MWheatLog extends Model
{
    //
    use SoftDeletes;

    public $table = "m_wheat_log";

    protected $fillable = [
        'qrcode_id', 'admin_id', 'poster', 'step', 'key_1', 'key_2', 'key_3', 'key_4'
    ];

    public function adminUser()
    {
        return $this->belongsTo('App\Models\AdminUsers', 'admin_id');
    }

    public function qrcode()
    {
        return $this->belongsTo('App\Models\MQrcodeInfo', 'qrcode_id');
    }
}
