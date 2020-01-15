<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rightmanagementmodel extends Model
{
    //
    protected $table = "role_master";
    protected $fillable = [
        'rolename', 'user_id',
    ];
}
