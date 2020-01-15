<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect, Response;
use Illuminate\Support\Facades\DB;
use App\Agenmastermodel;
use App\Agentcommissionmodel;

class Agentcommissioncotroller extends Controller
{
    //

    function index(Request $request)
    {

        $data['sidebar'] = DB::table('user_permission')->where('uid',session('role'))->get();
        return view('agentcommsion',$data);
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
        $result=array();
        $data1 = DB::table('ploaalocation_master')->where('agent_id',$agent)->get();
        foreach($data1 as $ploatdata){
            $sietid=$ploatdata->s_id;
            $sitename='';
         $data=DB::table('site_master')->where('id',$sietid)->get();
         foreach($data as $sitedata){
            $sitename=$sitedata->site_name;
         }
         $result[]=array(
            'id'=> $sietid,
            'site_name'=> $sitename,
         );


        }
        return $result;


    }
    public function getagentsiteploat(Request $request){
        $siteid=$request->id;
        $agentid=$request->agent;
        $result=array();
        $data1 = DB::table('ploaalocation_master')->where('agent_id',$agentid)->where('s_id',$siteid)->get();
        foreach($data1 as $ploatdata){
            $ploat_id=$ploatdata->ploat_id;
            $ploatno='';
         $data=DB::table('plot_detalis')->where('id',$ploat_id)->get();
         foreach($data as $sitedata){
            $ploatno=$sitedata->plots_no;
         }
         $result[]=array(
            'id'=> $ploat_id,
            'plots_no'=> $ploatno,
         );

        }
        return  $result;
    }
    public function store(Request $request)//For insert or Update Record Of class Master --
    {
        $ID = $request->save_update;

            $customer   =   Agentcommissionmodel::updateOrCreate(

                ['id' => $ID],
                [
                    'agent_id'        =>  $request->agentname,
                    'site_id'        =>  $request->sitename,
                    'ploats_id'        =>  $request->ploats,
                    'amtinfo'        =>  $request->crdr,
                    'amount'        =>  $request->amount,
                    'openingbalance'        =>  $request->openingbalance,
                    'user_id'        => 1,
                ]

            );
            $ref_id = $customer->id;

            return $ref_id;

    }
    public function getagentcommssioninfo(){

        $data = DB::table('agent_commision_master')

        ->join('agent_master', 'agent_master.id', '=', 'agent_commision_master.agent_id')
        ->join('site_master', 'site_master.id', '=', 'agent_commision_master.site_id')
        ->join('plot_detalis', 'plot_detalis.id', '=', 'agent_commision_master.ploats_id')
         ->select('agent_commision_master.*', 'site_master.site_name as site_name','agent_master.first_name as firstname','agent_master.last_name as lastname','plot_detalis.plots_no','agent_commision_master.id')
         ->orderBy('agent_master.id', 'DESC')
         ->get();

        return response()->json( $data);
    }
    public function getagentallcommssion(Request $request){
        $ploatid=$request->id;
        $agent=$request->agent;
        $sitename=$request->sitename;
        $cridt=0;
        $debit=0;
        $remain=0;
      $data = DB::table('agent_commision_master')->where('agent_id',$agent)->where('site_id',$sitename)->where('ploats_id',$ploatid)->where('amtinfo','cr')->get();
    $count=count($data);
    if($count >0){
        foreach($data as $agentc){
            $cridamt=$agentc->amount;
            $cridt= $cridt+ $cridamt;
         }
    }

    $data = DB::table('agent_commision_master')->where('agent_id',$agent)->where('site_id',$sitename)->where('ploats_id',$ploatid)->where('amtinfo','dr')->get();
    $count=count($data);
    if($count >0){
        foreach($data as $agentc){
            $dbitamt=$agentc->amount;
            $debit= $debit+ $dbitamt;
         }
    }
        $remain=$cridt- $debit;

        return $remain;
    }
    public function getagenthistory(Request $request){
        $ploatid=$request->id;
        $agent=$request->agent;
        $sitename=$request->sitename;
        $data = DB::table('agent_commision_master')->where('agent_id',$agent)->where('site_id',$sitename)->where('ploats_id',$ploatid)->get();
        return $data;
    }
}
