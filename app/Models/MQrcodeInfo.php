<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class MQrcodeInfo extends Model
{
    //
    use SoftDeletes;

    public $table = "m_qrcode_info";

    protected $fillable = [
        'type', 'name', 'url', 'admin_id' ,'unique_id'
    ];

    public function adminUser()
    {
        return $this->belongsToMany(Role::class);
    }

}