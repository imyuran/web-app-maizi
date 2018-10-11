<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MExpressionInfo extends Model
{
    //
    use SoftDeletes;

    public $table = "m_expression_info";

    protected $fillable = [
        'type', 'admin_id', 'poster', 'step', 'key_1', 'key_2', 'key_3', 'key_4'
    ];
}
