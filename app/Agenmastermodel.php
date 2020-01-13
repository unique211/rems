<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenmastermodel extends Model
{
    //
    protected $table = "agent_master";
    protected $fillable = [
        'first_name', 'last_name','email','city','userid','state','contry','pincode','bankname','branch_name','account_no','ifsc_code','account_holder_name','profilepicture',
    ];
}
