<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employmastermodel extends Model
{
    //

    protected $table = "employ_master";
    protected $fillable = [
        'firstname', 'last_name','email','mobile_no','profile_pic','user_id','role',
    ];
}

