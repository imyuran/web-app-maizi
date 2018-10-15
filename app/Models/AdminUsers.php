<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminUsers extends Model
{
    //
    public $table = "admin_users";

    protected $fillable = [
        'username', 'password', 'name', 'avatar', 'remember_token', 'created_at'
    ];
}
