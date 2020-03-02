<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect, Response;
use Illuminate\Support\Facades\DB;
use App\Agenmastermodel;
class CommsionReportController extends Controller
{
    //
    public function index(Request $request)
    {


       // $title['activemenu'] = "c";
       if (!$request->session()->exists('userid')) {
        // user value cannot be found in session
        return redirect('/');
    }else{
       $data['sidebar'] = DB::table('user_permission')->where('uid',session('role'))->get();
       $data['activemenu'] ='commssionrep';
        return view('commssionreport',$data);
    }
    }
    public function getagentcomreport(Request $request){
        $result=array();

        $data = DB::table('agent_master')->where('status',1)->get();
        $count = count($data);
        if($count >0){
            foreach($data as $agentdata){
                $agentnm=$agentdata->first_name." ".$agentdata->last_name;
                $agentid=$agentdata->id;

        $data1 = DB::table('site_master')->where('status',1)->get();

     foreach($data1 as $sitemasterdata){
            $siteid=$sitemasterdata->id;
            $sitename=$sitemasterdata->site_name;
            $data2 = DB::table('plot_detalis')->where('site_id',$siteid)->get();
            foreach($data2 as $plot_detalisdata){
                $ploatid=$plot_detalisdata->id;
                $plots_no=$plot_detalisdata->plots_no;
                $commssion=0;
                $paid=0;
                $remain=0;
                $data3 = DB::table('agent_commision_master')->where('agent_id',$agentid)->where('site_id',$siteid)->where('ploats_id',$ploatid)->get();
                foreach($data3 as $agentcommsiondata){
                    $amtinfo=$agentcommsiondata->amtinfo;
                    $amt=$agentcommsiondata->amount;

                    if($amtinfo=="cr"){
                        $commssion=$commssion+$amt;
                    }else{
                        $paid=$paid+$amt;
                    }

                }
                $remain=$commssion-$paid;
                if($commssion >0 || $paid >0){
                $result[]=array(
                    'agentnm'=>$agentnm,
                    'agentid'=>$agentid,
                    'sitename'=>$sitename,
                    'siteid'=>$siteid,
                    'ploatid'=>$ploatid,
                    'plots_no'=>$plots_no,
                    'commssion'=>$commssion,
                    'paid'=>$paid,
                    'remain'=>$remain,
                );
            }

            }


        }
    }
}
    return $result;

    }
    public function getagentrepcomssdata(Request $request){
        $result=array();
        $data3 = DB::table('ploaalocation_master');
        if($request->fromdate !="" && $request->todate !=""){
            $data3= $data3 ->whereDate('created_at', '>=', $request->fromdate)
            ->whereDate('created_at', '<=', $request->todate);

        }
        if($request->sitenm >0){
            $data3= $data3 ->where('s_id',$request->sitenm);

        }
        if($request->plot >0){
            $data3= $data3 ->where('ploat_id',$request->plot);

        }
        if($request->agentname >0){
            $data3= $data3 ->where('agent_id',$request->agentname);

        }
        $data3= $data3->get();
        foreach($data3 as $ploatallocationdata){
            $s_id=$ploatallocationdata->s_id;
            $ploat_id=$ploatallocationdata->ploat_id;
            $agent_id=$ploatallocationdata->agent_id;
            $sitenm='';
            $ploatnm='';
            $agentnm='';
            $data4 = DB::table('site_master')->where('id',$s_id)->get();
            foreach($data4 as $sitedata){
                $sitenm=$sitedata->site_name;
            }
            $data5 = DB::table('plot_detalis')->where('id',$ploat_id)->get();
            foreach($data5 as $ploatsdata){
                $ploatnm=$ploatsdata->plots_no;
            }

            $data6 = DB::table('agent_master')->where('id',$agent_id)->get();
            foreach($data6 as $agentdata){
                $agentnm=$agentdata->first_name." ".$agentdata->last_name;
            }
            $commssion=0;
            $paid=0;
            $remain=0;
            $data3 = DB::table('agent_commision_master')->where('agent_id',$agent_id)->where('site_id',$s_id)->where('ploats_id',$ploat_id)->get();
            foreach($data3 as $agentcommsiondata){
                $amtinfo=$agentcommsiondata->amtinfo;
                $amt=$agentcommsiondata->amount;

                if($amtinfo=="cr"){
                    $commssion=$commssion+$amt;
                }else{
                    $paid=$paid+$amt;
                }

            }
            $remain=$commssion-$paid;

            $result[]=array(
                'agentnm'=>$agentnm,
                'agentid'=>$agent_id,
                'sitename'=>$sitenm,
                'siteid'=>$s_id,
                'ploatid'=>$ploat_id,
                'plots_no'=>$ploatnm,
                'commssion'=>$commssion,
                'paid'=>$paid,
                'remain'=>$remain,
            );

        }
        return $result;
    }
    function getagentcommssionsite(Request $request){
        $result=array();

        $data4 = DB::table('ploaalocation_master')
        ->groupBy('s_id')
        ->get();
        foreach($data4 as $ploatallocationdata){
            $s_id=$ploatallocationdata->s_id;
            $site_name='';
            $data5= DB::table('site_master')->where('id',$s_id)->get();
            foreach($data5 as $sitedata){
                $site_name=$sitedata->site_name;
            }
            $result[]=array(
                'id'=>$s_id,
                'site_name'=>$site_name
            );
        }
        return $result;


    }
    function getsiteploats(Request $request){
        $data4 = DB::table('ploaalocation_master')
        ->where('s_id',$request->id)
        ->get();
        foreach($data4 as $ploatallocationdata){
            $ploat_id=$ploatallocationdata->ploat_id;
            $plots_no='';
            $data5= DB::table('plot_detalis')->where('id',$ploat_id)->get();
            foreach($data5 as $ploatsdaat){
                $plots_no=$ploatsdaat->plots_no;
            }
            $result[]=array(
                'id'=>$ploat_id,
                'plots_no'=>$plots_no
            );
        }
        return $result;
    }
    function getallagentdrop(Request $request){
        $data4 = DB::table('ploaalocation_master')
        ->groupBy('agent_id')
        ->get();
        foreach($data4 as $ploatallocationdata){
            $agent_id=$ploatallocationdata->agent_id;
            $agent_name='';
            $data5= DB::table('agent_master')->where('id',$agent_id)->get();
            foreach($data5 as $ploatsdaat){
                $agent_name=$ploatsdaat->first_name." ".$ploatsdaat->last_name;
            }
            $result[]=array(
                'id'=>$agent_id,
                'agent_name'=>$agent_name
            );
        }
        return $result;
    }
    function getploatsagentinfo(Request $request){
        $data4 = DB::table('ploaalocation_master')
        ->where('ploat_id',$request->id)
        ->get();
        foreach($data4 as $ploatallocationdata){
            $agent_id=$ploatallocationdata->agent_id;
            $agent_name='';
            $data5= DB::table('agent_master')->where('id',$agent_id)->get();
            foreach($data5 as $ploatsdaat){
                $agent_name=$ploatsdaat->first_name." ".$ploatsdaat->last_name;
            }
            $result[]=array(
                'id'=>$agent_id,
                'agent_name'=>$agent_name
            );
        }
        return $result;
    }
}
