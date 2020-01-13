<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect, Response;
use Illuminate\Support\Facades\DB;
use App\Agenmastermodel;

class Agentcommissioncotroller extends Controller
{
    //

    function index(Request $request)
    {


        return view('agentcommsion');
    }
    public function getdropagentcommission(){



                $result=array();
            $data = DB::table('agent_master')->get();
            foreach($data as $ploatdata){
                $agentid=$ploatdata->id;
                $first_name=$ploatdata->first_name;
                $last_name=$ploatdata->last_name;

                $data1 = DB::table('ploaalocation_master')->where('agent_id',$agentid)->get();
                    $count=count($data1);
                    if($count >0){
                        $result[]=array(
                            'id'=>$agentid,
                            'first_name'=>$first_name,
                            'last_name'=>$last_name,
                        );
                    }

            }
            return $result;
    }
    public function getagentsite(Request $request){
        $agent=$request->id;
     //   $data = DB::table('site_master')->->get();

        //return $result;
    }
}
