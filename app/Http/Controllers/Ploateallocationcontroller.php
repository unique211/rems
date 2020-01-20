<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect, Response;
use Illuminate\Support\Facades\DB;
use App\Plotalocatiomodel;

class Ploateallocationcontroller extends Controller
{
    //
  public  function index(Request $request)
    {
        if (!$request->session()->exists('userid')) {
            // user value cannot be found in session
            return redirect('/');
        }else{
        $data['sidebar'] = DB::table('user_permission')->where('uid',session('role'))->get();
        $data['activemenu'] ='ploatal';
        return view('ploateallocation',$data);
        }
    }
    public function getdropcustomer(){
        $data = DB::table('customer_master')->get();
            return response()->json($data);
    }
    public function getdropsites(){
        $data = DB::table('site_master')->get();
        return response()->json($data);
    }
    public function getsiteplots(Request $request){
        $sid=$request->saveid;
        if($sid > 0){
            $result=array();
        $data = DB::table('plot_detalis')->where('site_id',$request->id)->get();
        foreach($data as $ploatdata){
            $plots_no=$ploatdata->plots_no;
            $plotsid=$ploatdata->id;

            $data1 = DB::table('ploaalocation_master')->where('ploat_id','!=',$plotsid)->get();
                $count=count($data1);
                if($count >0){
                    $result[]=array(
                        'id'=>$plotsid,
                        'plots_no'=>$plots_no,
                    );
                }

                $data2 = DB::table('ploaalocation_master')->where('id',$sid)->where('ploat_id',$plotsid)->get();
                $count1=count($data2);
                if($count1 >0){
                    $result[]=array(
                        'id'=>$plotsid,
                        'plots_no'=>$plots_no,
                    );
                }
        }

        return $result;
        }else{
            $result=array();
            $data = DB::table('plot_detalis')->where('site_id',$request->id)->get();
            foreach($data as $ploatdata){
                $plots_no=$ploatdata->plots_no;
                $plotsid=$ploatdata->id;

                $data = DB::table('ploaalocation_master')->where('ploat_id','!=',$plotsid)->get();
                $count=count($data);
                if($count >0){
                    $result[]=array(
                        'id'=>$plotsid,
                        'plots_no'=>$plots_no,
                    );
                }else{
                    $result[]=array(
                        'id'=>$plotsid,
                        'plots_no'=>$plots_no,
                    );
                }

            }
            return $result;
        }
    }
    public function getploatamtsqftdata(Request $request){
        $data = DB::table('plot_detalis')->where('id',$request->id)->get();
        return response()->json($data);
    }
    public function getdropagent(){
        $data = DB::table('agent_master')->get();
        return response()->json($data);
    }

    public function store(Request $request)//For insert or Update Record Of class Master --
    {
        $ID = $request->save_update;



            $customer   =   Plotalocatiomodel::updateOrCreate(

                ['id' => $ID],
                [
                    'c_id'        =>  $request->customername,
                    's_id'        =>  $request->sitename,
                    'ploat_id'        =>  $request->ploats,
                    'amt'        =>  $request->amount,
                    'agent_id'        =>  $request->agent,
                    'status'        => 1,
                    'user_id'        => $request->session()->get('userid'),
                ]

            );
            $ref_id = $customer->id;


            $u_rights = array(
                'p_a_id' => $ref_id,
                'c_id' =>  $request->customername,
                'amount' =>  $request->payamount,
                'payment_mode' =>  $request->paymentmode,
                'remark' =>  $request->remark,
                'bank_name' =>  $request->bankname,
                'branch_name' =>  $request->branch,
                'cheque_no' =>  $request->chequeno,
                'c_date' =>  $request->checktime,
                'account_no' =>  $request->accountno,
                'transaction_note' =>  $request->tnote,
                'user_id'=>1,


            );

                $result =  DB::table('customer_payment')
                ->Insert($u_rights);

            return $ref_id;

    }
    public function getallploatallocation(){
        $result=array();
        $data = DB::table('ploaalocation_master')->get();

        foreach($data as $ploatdaat){
            $palid=$ploatdaat->id;
            $c_id=$ploatdaat->c_id;
            $s_id=$ploatdaat->s_id;
            $ploat_id=$ploatdaat->ploat_id;
            $amt=$ploatdaat->amt;
            $agent_id=$ploatdaat->agent_id;
            $c_name='';
            $c_lastanme='';
            $s_name='';
            $ploat_name='';
            $agent_name='';
            $agent_lastname='';

            if($c_id >0){
                $data1 = DB::table('customer_master')->where('id', $c_id)->get();
                foreach($data1 as $coustomerdata){
                    $c_name=$coustomerdata->first_name;
                    $c_lastanme=$coustomerdata->last_name;
                }
            }

            if($s_id >0){
                $data2 = DB::table('site_master')->where('id', $s_id)->get();
                foreach($data2 as $site_masterdata){
                    $s_name=$site_masterdata->site_name;

                }
            }

            if($ploat_id >0){
                $data3 = DB::table('plot_detalis')->where('id', $ploat_id)->get();
                foreach($data3 as $plot_detalisdata){
                    $ploat_name=$plot_detalisdata->plots_no;

                }
            }
            if($agent_id >0){
                $data4 = DB::table('agent_master')->where('id', $agent_id)->get();
                foreach($data4 as $agentdata){
                    $agent_name=$agentdata->first_name;
                    $agent_lastname=$agentdata->last_name;
                }
            }
            $result[]=array(
                'id'=>$palid,
                'c_id'=>$c_id,
                's_id'=>$s_id,
                'ploat_id'=>$ploat_id,
                'amt'=>$amt,
                'agent_id'=>$agent_id,
                'c_name'=>$c_name,
                'c_lastanme'=>$c_lastanme,
                's_name'=>$s_name,
                'ploat_name'=>$ploat_name,
                'agent_name'=>$agent_name,
                'agent_lastname'=>$agent_lastname,
            );
        }
        return $result;
    }
    public function getpaymenthistory(Request $request){
        $data3 = DB::table('customer_payment')->where('p_a_id', $request->id)->get();
        return response()->json($data3);
    }
    public function deleteploatalocate($id){
        DB::table('customer_payment')->where('p_a_id', $id)->delete();
        $data = DB::table('ploaalocation_master')->where('id',$id)->delete();
        return $data;
    }

}
