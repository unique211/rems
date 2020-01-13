<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plotalocatiomodel extends Model
{
    //
    protected $table = "ploaalocation_master";
    protected $fillable = [
        'c_id', 's_id','ploat_id','amt','agent_id','user_id',
    ];
}
