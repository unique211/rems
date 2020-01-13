<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sitemastermodel extends Model
{
    //
    protected $table = "site_master";
    protected $fillable = [
        'site_name', 'area_name','total_ploat','total_areaof_ploats','user_id',
    ];
}
