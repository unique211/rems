<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect, Response;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    //
    function index(Request $request)
    {
    $data['sidebar'] = DB::table('user_permission')->where('uid',session('role'))->get();
    $data['activemenu'] ='dashm';
    return view('dashboard',$data);
    }
    public function getdashboarddata(){
        $result=array();

        $data= DB::table("ploaalocation_master")->get();
        $count=count($data);


        $data1= DB::table("customer_master")->get();
        $count1=count($data1);

        $data2= DB::table("agent_master")->get();
        $count2=count($data2);

        $data3 = DB::table("customer_payment")->sum('amount');


        $crsum=0;
        $drsum=0;
        $per=0;
        $perinfo=0;
        $data4= DB::table('agent_commision_master')->where('amtinfo', 'cr')->where('status', '1')->get();
        $count4=count($data4);
        if($count4 >0){
            foreach($data4 as $cramountinfo){
                $amt=$cramountinfo->amount;
                $crsum= $crsum+$amt;
            }
        }

        $data5= DB::table('agent_commision_master')->where('amtinfo', 'dr')->where('status', '1')->get();
        $count5=count($data5);
        if($count5 >0){
            foreach($data5 as $cramountinfo){
                $amt=$cramountinfo->amount;
                $drsum= $drsum+$amt;
            }
        }

        // if($drsum >0 && $crsum >0){

        //     $perinfo=round(($drsum*100)/$crsum);

        // }else if($drsum==0 && $crsum >0){
        //     $perinfo=100;
        // }else if($drsum==0 && $crsum==0){
        //     $perinfo=0;
        // }
        $agensum= $crsum- $drsum;
        $result[]=array(
            'saleplots'=>$count,
            'totalcustomer'=>$count1,
            'totalagent'=>$count2,
            'customerpayment'=>$data3,
            'perinfo'=>$agensum,
        );

        return $result;


    }

    public function getagentinfo(){
        $result=array();
        $data2= DB::table("agent_master")->get();
        $count2=count($data2);
        foreach($data2 as $ageninfo){
            $agentid=$ageninfo->id;
            $first_name=$ageninfo->first_name;
            $last_name=$ageninfo->last_name;
            $email=$ageninfo->email;
            $profilepicture=$ageninfo->profilepicture;
            $crsum=0;
        $drsum=0;
        $per=0;
        $perinfo=0;
        $data4= DB::table('agent_commision_master')->where('agent_id',$agentid)->where('amtinfo', 'cr')->where('status', '1')->get();
        $count4=count($data4);
        if($count4 >0){
            foreach($data4 as $cramountinfo){
                $amt=$cramountinfo->amount;
                $crsum= $crsum+$amt;
            }
        }

        $data5= DB::table('agent_commision_master')->where('agent_id',$agentid)->where('amtinfo', 'dr')->where('status', '1')->get();
        $count5=count($data5);
        if($count5 >0){
            foreach($data5 as $cramountinfo){
                $amt=$cramountinfo->amount;
                $drsum= $drsum+$amt;
            }
        }
        $agensum= $crsum- $drsum;

        $result[]=array(
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'email'=>$email,
            'agensum'=>$agensum,
            'profilepicture'=>$profilepicture,
        );
            //last changes
        }
        return $result;

    }
    public function getagentploatsale(Request $request){


        $result=array();

        function getWeekDates($date, $start_date, $end_date) {
            $week = date('W', strtotime($date));
            $year = date('Y', strtotime($date));
            $from = date("Y-m-d", strtotime("{$year}-W{$week}+1"));

            if ($from < $start_date)
                $from = $start_date;

            $to = date("Y-m-d", strtotime("{$year}-W{$week}-7"));
            if ($to > $end_date)
                $to = $end_date;

            $array1 = array(
                "ssdate" => $from,
                "eedate" => $to,
            );

            return $array1;
        }

        $mm = date('m');
        $yy = date('y');
        $startdate = date($yy . "-" . $mm . "-01");
        $current_date = date('Y-m-t');
        $ld = cal_days_in_month(CAL_GREGORIAN, $mm, $yy);
        $lastday = $yy . '-' . $mm . '-' . $ld;
        $start_date = date('Y-m-d', strtotime($startdate));
        $end_date = date('Y-m-d', strtotime($lastday));
        $end_date1 = date('Y-m-d', strtotime($lastday . " + 7 days"));
        $count_week = 0;
        $week_array = array();

        // for ($date = $start_date; $date < $end_date1; $date = date('Y-m-d', strtotime($date . ' + 7 days'))) {
        //     $getarray = getWeekDates($date, $start_date, $end_date);
        //     $week_array[] = $getarray;
        //     $count_week++;
        // }

        for ($date = $start_date; $date <= $end_date1; $date = date('Y-m-d', strtotime($date . ' + 7 days'))) {
            $getarray = getWeekDates($date, $start_date, $end_date);
            if(count($getarray))
            {
              $week_array[] = $getarray;
              $count_week++;
            }


        }
        $createdarray = array();
        $firstarray=array();
        $secondarray=array();

        foreach($week_array as $weekinfo){
            $data5= DB::table('ploaalocation_master')->whereDate('created_at', '>=', $weekinfo['ssdate'])->whereDate('created_at', '<=', $weekinfo['eedate'])->sum('amt');

            $data6= DB::table('customer_payment')->whereDate('create_at', '>=', $weekinfo['ssdate'])->whereDate('create_at', '<=', $weekinfo['eedate'])->sum('amount');

           // array_push($firstarray,$data5);
            $firstarray[]=array(
                'sum1'=>$data5,

            );
            $secondarray[]=array(
                'sum2'=>$data6,
            );

        }

        $result[]=array(
            'firstar'=>$firstarray,
            'secondarr'=>$secondarray,
            'week_array'=>$week_array,
        );
        return $result;
    }


}
