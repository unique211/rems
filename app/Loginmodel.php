<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loginmodel extends Model
{
    //

    protected $table = "login_master";
    protected $fillable = [
        'e_id', 'user_name','password','role',
    ];
}
