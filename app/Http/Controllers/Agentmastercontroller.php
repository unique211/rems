<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect, Response;
use Illuminate\Support\Facades\DB;
use App\Agenmastermodel;
class Agentmastercontroller extends Controller
{
    //
  public  function index(Request $request)
    { if (!$request->session()->exists('userid')) {
        // user value cannot be found in session
        return redirect('/');
    }else{

        $data['sidebar'] = DB::table('user_permission')->where('uid',session('role'))->get();
        $data['activemenu'] ='agenti';
        return view('agentmaster',$data);
    }
    }
    public function store(Request $request)//For insert or Update Record Of class Master --
    {
        $ID = $request->save_update;

        if($ID >0){
            $data = DB::table('agent_master')->where('id', '!=', $ID)->where('advisor_id',$request->advisor_id)->get();
            $count = count($data);
            if($count >0){
                return '0';
            }else{
            $customer   =   Agenmastermodel::updateOrCreate(

                ['id' => $ID],
                [
                    'advisor_id'        =>  $request->advisor_id,
                    'first_name'        =>  $request->firstname,
                    'last_name'        =>  $request->lastname,
                    'email'        =>  $request->email,
                    'city'        =>  $request->city,
                    'state'        =>  $request->state,
                    'contry'        =>  $request->contry,
                    'pincode'        =>  $request->pincode,
                    'bankname'        =>  $request->bankname,
                    'branch_name'        =>  $request->branch,
                    'account_no'        =>  $request->accno,
                    'ifsc_code'        =>  $request->ifsccode,
                    'account_holder_name'        =>  $request->accountholder,
                    'profilepicture'        =>  $request->profileimg,
                    'userid'        => $request->session()->get('userid'),
                ]

            );
            $ref_id = $customer->id;

            return $ref_id;
        }

        }else{

            $data = DB::table('agent_master')->where('advisor_id',$request->advisor_id)->get();
            $count = count($data);
            if($count >0){
                return '0';
            }else{
            $customer   =   Agenmastermodel::updateOrCreate(

                ['id' => $ID],
                [
                    'advisor_id'        =>  $request->advisor_id,
                    'first_name'        =>  $request->firstname,
                    'last_name'        =>  $request->lastname,
                    'email'        =>  $request->email,
                    'city'        =>  $request->city,
                    'state'        =>  $request->state,
                    'contry'        =>  $request->contry,
                    'pincode'        =>  $request->pincode,
                    'bankname'        =>  $request->bankname,
                    'branch_name'        =>  $request->branch,
                    'account_no'        =>  $request->accno,
                    'ifsc_code'        =>  $request->ifsccode,
                    'account_holder_name'        =>  $request->accountholder,
                    'profilepicture'        =>  $request->profileimg,
                    'userid'        => $request->session()->get('userid'),
                ]

            );
            $ref_id = $customer->id;

            return $ref_id;
        }
        }

    }
    public function getallagent(){
        $data = DB::table('agent_master')->get();


        return response()->json($data);
    }
    public function editagent(Request $request){
        $data = DB::table('agent_master')->where('id',$request->id)->get();


        return response()->json($data);
    }
    public function deleteagent($id){
        $data = DB::table('agent_master')->where('id',$id)->delete();


        return response()->json($data);
    }
    public function uplaodprofieagent(Request $request){


        $extension = $request->file('file')->getClientOriginalExtension();

        $dir = 'profile/';
        $filename = uniqid() . '_' . time() . '.' . $extension;

       // echo  dd($filename);
        $request->file('file')->move($dir, $filename);


        return $filename;

    }
    public function updateagentinfo(Request $request){
        $data = DB::table('agent_master')->where('id', '!=', $request->save_update)->where('advisor_id',$request->advisor_id)->get();
        $count = count($data);
        if($count >0){
            return '100';
        }else{

        $updatecust = array(
            'first_name' => $request->firstname,
            'last_name' =>  $request->lastname,
            'email' =>  $request->email,
            'city' =>  $request->city,
            'state' =>  $request->state,
            'contry' =>  $request->contry,
            'pincode' =>  $request->pincode,
            'profilepicture' =>  $request->profileimg,
            'advisor_id' =>  $request->advisor_id,

        );
       $data= DB::table('agent_master')->where('id', $request->save_update)->update($updatecust);
       return $data;
    }
    }
    public function getagentpayment(Request $request){
        $agentid=$request->id;
        $crsum=0;
        $drsum=0;
        $per=0;
        $perinfo=0;
        $data= DB::table('agent_commision_master')->where('agent_id', $agentid)->where('amtinfo', 'cr')->where('status', '1')->get();
        $count=count($data);
        if($count >0){
            foreach($data as $cramountinfo){
                $amt=$cramountinfo->amount;
                $crsum= $crsum+$amt;
            }
        }

        $data1= DB::table('agent_commision_master')->where('agent_id', $agentid)->where('amtinfo', 'dr')->where('status', '1')->get();
        $count1=count($data1);
        if($count1 >0){
            foreach($data1 as $cramountinfo){
                $amt=$cramountinfo->amount;
                $drsum= $drsum+$amt;
            }
        }

        if($drsum >0 && $crsum >0){

            $perinfo=round(($drsum*100)/$crsum);

        }else if($drsum==0 && $crsum >0){
            $perinfo=100;
        }else if($drsum==0 && $crsum==0){
            $perinfo=0;
        }

        return $perinfo;
    }
}
