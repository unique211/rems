<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agentcommissionmodel extends Model
{
    //

    protected $table = "agent_commision_master";
    protected $fillable = [
        'agent_id', 'ploats_id','amtinfo','amount','user_id','site_id','openingbalance',
    ];
}
