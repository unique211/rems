<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect, Response;
use Illuminate\Support\Facades\DB;
use App\Agenmastermodel;
class Soldplotcontroller extends Controller
{
    //

    public function index(Request $request){
        if (!$request->session()->exists('userid')) {
            // user value cannot be found in session
            return redirect('/');
        }else{
        $data['sidebar'] = DB::table('user_permission')->where('uid',session('role'))->get();
        $data['activemenu'] ='soldreport';
        return view('soldploatrep',$data);
        }
    }
    public function getsoldloatsdata(Request $request){
        $result=array();
        $data = DB::table('plot_detalis')
        ->join('site_master', 'site_master.id', '=', 'plot_detalis.site_id')
        ->join('login_master', 'login_master.id', '=', 'site_master.user_id')
        ->join('employ_master', 'employ_master.id', '=', 'login_master.e_id');
        if($request->sitenm >0){
            $data = $data  ->where('site_master.id',$request->sitenm);
        }
    $data =$data->select('plot_detalis.*', 'site_master.site_name as site_name','login_master.user_name','employ_master.firstname','employ_master.last_name')
        ->get();
    $count=count($data);
    if($count > 0){
        foreach($data as $ploatdata){
            $ploatid=$ploatdata->id;
            $plots_no=$ploatdata->plots_no;
            $area_insqft=$ploatdata->area_insqft;
            $persqftrate=$ploatdata->persqftrate;
            $cost=$ploatdata->cost;
            $sitename=$ploatdata->site_name;
            $user_name=$ploatdata->user_name;
            $firstname=$ploatdata->firstname;
            $last_name=$ploatdata->last_name;
            $coustid="";
            $agentid="";
            $ploatalid="";
            $pstatus="";
            $allocatedate="";
            $amount="";
            $cfname="";
            $clname="";

            $afname="";
            $alname="";


            $data1 = DB::table('ploaalocation_master')->where('ploat_id',$ploatid)->get();
           $count1=count($data1);
           if($count1 >0){
                foreach($data1 as $ploatalocate){
                    $ploatalid=$ploatalocate->id;
                    $coustid=$ploatalocate->c_id;
                    $agent_id=$ploatalocate->agent_id;
                    $amount=$ploatalocate->amt;
                    $allocatedate=$ploatalocate->created_at;

                    if( $coustid >0){
                        $data7= DB::table('customer_master')->where('id',$coustid)->get();
                        foreach($data7 as $customerdata){
                            $cfname=$customerdata->first_name;
                            $clname=$customerdata->last_name;
                        }
                    }

                    if( $agent_id >0){
                        $data7= DB::table('agent_master')->where('id',$agent_id)->get();
                        foreach($data7 as $customerdata){
                            $afname=$customerdata->first_name;
                            $alname=$customerdata->last_name;
                        }
                    }else{
                        $afname="N";
                        $alname="/A";
                    }

                    $data6= DB::table('customer_payment')->where('p_a_id',$ploatalid)->sum('amount');
                    if($data6== 0){
                        $pstatus='No Payment';
                    }else if($data6== $amount){
                        $pstatus="Full Payment";
                    }else{
                        $pstatus="Partial Payment";
                    }

                    $result[]=array(
                        'ploatid'=>$ploatid,
                        'plots_no'=>$plots_no,
                        'area_insqft'=>$area_insqft,
                        'persqftrate'=>$persqftrate,
                        'cost'=>$cost,
                        'sitename'=>$sitename,
                        'firstname'=>$firstname,
                        'last_name'=>$last_name,
                        'coustid'=>$coustid,
                        'agent_id'=>$agent_id,
                        'cfname'=>$cfname,
                        'clname'=>$clname,
                        'afname'=>$afname,
                        'alname'=>$alname,
                        'pstatus'=>$pstatus,
                        'allocatedate'=>$allocatedate,
                    );


                }


           }

        }
    }
    return $result;
    }
}
