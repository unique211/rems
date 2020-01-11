<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customermodel extends Model
{
    //

    protected $table = "customer_master";
    protected $fillable = [
        'first_name', 'last_name','email','city','user_id','state','contry','pincode','relativename','mobileno','address',
    ];
}
