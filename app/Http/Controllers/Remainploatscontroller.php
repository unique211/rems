<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect, Response;
use Illuminate\Support\Facades\DB;
use App\Agenmastermodel;
class Remainploatscontroller extends Controller
{
    //

    public function index(Request $request){
        if (!$request->session()->exists('userid')) {
            // user value cannot be found in session
            return redirect('/');
        }else{
        $data['sidebar'] = DB::table('user_permission')->where('uid',session('role'))->get();
        $data['activemenu'] ='remainreport';
        return view('remainploats',$data);
        }
    }
    public function getremainploatsdata(Request $request){
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

            $data1 = DB::table('ploaalocation_master')->where('ploat_id','!=',$ploatid)->get();
           $count1=count($data1);
           if($count1 >0){
            $result[]=array(
                'ploatid'=>$ploatid,
                'plots_no'=>$plots_no,
                'area_insqft'=>$area_insqft,
                'persqftrate'=>$persqftrate,
                'cost'=>$cost,
                'sitename'=>$sitename,
                'firstname'=>$firstname,
                'last_name'=>$last_name,
            );
           }

        }
    }

    return $result;
    }
}
