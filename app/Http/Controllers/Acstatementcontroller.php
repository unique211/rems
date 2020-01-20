<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect, Response;
use Illuminate\Support\Facades\DB;
use App\Agenmastermodel;
use DateTime;
use DatePeriod;
use DateInterval;

class Acstatementcontroller extends Controller
{
    //

    public function index(Request $request){
        if (!$request->session()->exists('userid')) {
            // user value cannot be found in session
            return redirect('/');
        }else{
        $data['sidebar'] = DB::table('user_permission')->where('uid',session('role'))->get();
        $data['activemenu'] ='acreport';
        return view('acstatementreport',$data);
        }
    }
    public function getagentrepdata(Request $request){



        $agentname=$request->agentname;
        $sitenm=$request->sitenm;
        $plot=$request->plot;
        $fromdate=$request->fromdate;
        $todate=$request->todate;


        $result=array();

        if($fromdate=="" &&  $todate ==""){

            $data = DB::table('agent_commision_master')
            ->join('agent_master', 'agent_master.id', '=', 'agent_commision_master.agent_id')
            ->join('site_master', 'site_master.id', '=', 'agent_commision_master.site_id')
            ->join('plot_detalis', 'plot_detalis.id', '=', 'agent_commision_master.ploats_id')
            ->where('agent_id',$agentname);
          //  ->where('amtinfo','cr')
            //->whereDate('agent_commision_master.created_at',$fetdate);
            if($sitenm >0){
                $data =$data->where('agent_commision_master.site_id',$sitenm);
            }
            if($plot >0){
                $data =$data->where('agent_commision_master.ploats_id',$plot);
            }

            $data =$data->select('agent_commision_master.*', 'site_master.site_name as site_name','agent_master.first_name as firstname','agent_master.last_name as lastname','plot_detalis.plots_no','agent_commision_master.id')
             ->orderBy('agent_commision_master.id', 'asc')
             ->get();
             $count=count($data);
             if($count >0){
                foreach($data as $ploatdata){
                $date=$ploatdata->created_at;
                $pid=$ploatdata->id;
                $ploats_id=$ploatdata->ploats_id;
                $agent_id=$ploatdata->agent_id;
                $site_id=$ploatdata->site_id;

                $site_name=$ploatdata->site_name;
                $firstname=$ploatdata->firstname;
                $lastname=$ploatdata->lastname;
                $plots_no=$ploatdata->plots_no;
                $amtinfo=$ploatdata->amtinfo;

                $cramt=$ploatdata->amount;


                //$crtoamt= DB::table('agent_commision_master')->where('site_id',$site_id)->where('agent_id',$agentname)->where('ploats_id',$ploats_id)->whereDate('id', $fetdate)->where('amtinfo','cr')->sum('amount');

                $cramtd= DB::table('agent_commision_master')->where('site_id',$site_id)->where('agent_id',$agentname)->where('ploats_id',$ploats_id)->where('id', '<', $pid)->where('amtinfo','cr')->sum('amount');
                $dramtd= DB::table('agent_commision_master')->where('site_id',$site_id)->where('agent_id',$agentname)->where('ploats_id',$ploats_id)->where('id', '<', $pid)->where('amtinfo','dr')->sum('amount');

                $opbalance=$cramtd- $dramtd;

                   // echo $opbalance;
                    if($amtinfo=="cr"){
                        $balance=$opbalance+$cramt;
                    }else{
                        $balance=$opbalance-$cramt;
                    }





                    $result[]=array(
                        'date'=>$date,
                        'site_name'=>$site_name,
                        'firstname'=>$firstname,
                        'lastname'=>$lastname,
                        'plots_no'=>$plots_no,
                        //'crtoamt'=>$crtoamt,
                        'amtinfo'=>$amtinfo,
                        'cramt'=>$cramt,
                        'opbalance'=>$opbalance,
                        'balance'=>$balance,
                    );




            }
            }
            return $result;





        }else{


            function getDatesFromRange($start, $end, $format = 'Y-m-d') {
                $array = array();
                $interval = new DateInterval('P1D');

                $realEnd = new DateTime($end);
                $realEnd->add($interval);

                $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

                foreach($period as $date) {

                    $array[] = $date->format($format);

                }

                return $array;
            }

            $datedata=getDatesFromRange($fromdate,$todate);

            foreach($datedata as $fetdate){


                $date='';
                $site_name='';
                $firstname='';
                $lastname='';
                $plots_no='';
                $amtinfo='';
                $crtoamt='';
                $cramt='';
                $balance='';
                $ploatid='';
            $data = DB::table('agent_commision_master')
            ->join('agent_master', 'agent_master.id', '=', 'agent_commision_master.agent_id')
            ->join('site_master', 'site_master.id', '=', 'agent_commision_master.site_id')
            ->join('plot_detalis', 'plot_detalis.id', '=', 'agent_commision_master.ploats_id')
            ->where('agent_id',$agentname)
          //  ->where('amtinfo','cr')
            ->whereDate('agent_commision_master.created_at',$fetdate);
            if($sitenm >0){
                $data =$data->where('agent_commision_master.site_id',$sitenm);
            }
            if($plot >0){
                $data =$data->where('agent_commision_master.ploats_id',$plot);
            }

            $data =$data->select('agent_commision_master.*', 'site_master.site_name as site_name','agent_master.first_name as firstname','agent_master.last_name as lastname','plot_detalis.plots_no','agent_commision_master.id')
             ->orderBy('agent_commision_master.id', 'asc')
             ->get();
             $count=count($data);
             if($count >0){
                foreach($data as $ploatdata){
                $date=$ploatdata->created_at;
                $pid=$ploatdata->id;
                $ploats_id=$ploatdata->ploats_id;
                $agent_id=$ploatdata->agent_id;
                $site_id=$ploatdata->site_id;

                $site_name=$ploatdata->site_name;
                $firstname=$ploatdata->firstname;
                $lastname=$ploatdata->lastname;
                $plots_no=$ploatdata->plots_no;
                $amtinfo=$ploatdata->amtinfo;

                $cramt=$ploatdata->amount;


                //$crtoamt= DB::table('agent_commision_master')->where('site_id',$site_id)->where('agent_id',$agentname)->where('ploats_id',$ploats_id)->whereDate('id', $fetdate)->where('amtinfo','cr')->sum('amount');

                $cramtd= DB::table('agent_commision_master')->where('site_id',$site_id)->where('agent_id',$agentname)->where('ploats_id',$ploats_id)->where('id', '<', $pid)->where('amtinfo','cr')->sum('amount');
                $dramtd= DB::table('agent_commision_master')->where('site_id',$site_id)->where('agent_id',$agentname)->where('ploats_id',$ploats_id)->where('id', '<', $pid)->where('amtinfo','dr')->sum('amount');

                $opbalance=$cramtd- $dramtd;

                   // echo $opbalance;
                    if($amtinfo=="cr"){
                        $balance=$opbalance+$cramt;
                    }else{
                        $balance=$opbalance-$cramt;
                    }





                    $result[]=array(
                        'date'=>$date,
                        'site_name'=>$site_name,
                        'firstname'=>$firstname,
                        'lastname'=>$lastname,
                        'plots_no'=>$plots_no,
                        //'crtoamt'=>$crtoamt,
                        'amtinfo'=>$amtinfo,
                        'cramt'=>$cramt,
                        'opbalance'=>$opbalance,
                        'balance'=>$balance,
                    );




            }
            }


            // $drdate1='';
            // $drsite_name='';
            // $drfirstname='';
            // $drlastname='';
            // $drplots_no='';
            // $dramtinfo='';
            // $dramt='';
            // $drbalance='';
            // $drploatsid='';
            // $data = DB::table('agent_commision_master')
            // ->join('agent_master', 'agent_master.id', '=', 'agent_commision_master.agent_id')
            // ->join('site_master', 'site_master.id', '=', 'agent_commision_master.site_id')
            // ->join('plot_detalis', 'plot_detalis.id', '=', 'agent_commision_master.ploats_id')
            // ->where('agent_id',$agentname)
            // ->where('amtinfo','dr')
            // ->whereDate('agent_commision_master.created_at',$fetdate);

            // if($sitenm >0){
            //     $data =$data->where('agent_commision_master.site_id',$sitenm);
            // }
            // if($plot >0){
            //     $data =$data->where('agent_commision_master.ploats_id',$plot);
            // }
            // $data =$data->select('agent_commision_master.*', 'site_master.site_name as site_name','agent_master.first_name as firstname','agent_master.last_name as lastname','plot_detalis.plots_no','agent_commision_master.id')
            //  ->orderBy('agent_master.id', 'asc')
            //  ->get();
            //  $count1=count($data);
            //  if($count1 >0){
            //     foreach($data as $ploatdata){
            //     $drdate1=$ploatdata->created_at;

            //     $drsite_name=$ploatdata->site_name;
            //     $drfirstname=$ploatdata->firstname;
            //     $drlastname=$ploatdata->lastname;
            //     $drplots_no=$ploatdata->plots_no;
            //     $dramtinfo=$ploatdata->amtinfo;
            //     $pid=$ploatdata->id;
            //     $date=$ploatdata->created_at;
            //     $ploats_id=$ploatdata->ploats_id;
            //     $agent_id=$ploatdata->agent_id;
            //     $site_id=$ploatdata->site_id;
            //     $dramt= $ploatdata->amount;
            //     // $dramt= DB::table('agent_commision_master')->where('site_id',$site_id)->where('agent_id',$agentname)->where('ploats_id',$ploats_id)->whereDate('created_at', $fetdate)->where('amtinfo','dr')->sum('amount');

            //     // $cr1amt= DB::table('agent_commision_master')->where('site_id',$site_id)->where('agent_id',$agentname)->where('ploats_id',$ploats_id)->whereDate('created_at', '>=', $fromdate)->whereDate('created_at', '<=', $fetdate)->where('amtinfo','cr')->sum('amount');

            //     //     $drbalance=$cr1amt-$dramt;

            //         $cramtd1= DB::table('agent_commision_master')->where('site_id',$site_id)->where('agent_id',$agentname)->where('ploats_id',$ploats_id)->where('id', '<', $pid)->where('amtinfo','cr')->sum('amount');
            //         $dramtd1= DB::table('agent_commision_master')->where('site_id',$site_id)->where('agent_id',$agentname)->where('ploats_id',$ploats_id)->where('id', '<', $pid)->where('amtinfo','dr')->sum('amount');


            //         $opbalance1=$cramtd1- $dramtd1;
            //         $drbalance=$opbalance1-$dramt;

            //             $result[]=array(
            //                 'date'=>$drdate1,
            //                 'site_name'=>$drsite_name,
            //                 'firstname'=>$drfirstname,
            //                 'lastname'=>$drlastname,
            //                 'plots_no'=>$drplots_no,
            //                // 'crtoamt'=>$dramt,
            //                 'amtinfo'=>$dramtinfo,
            //                 'cramt'=>$dramt,
            //                 'balance'=>$drbalance,
            //                 'opbalance'=>$opbalance1,
            //             );



            // }
            // }


        }
        return $result;
    }



    }
}
