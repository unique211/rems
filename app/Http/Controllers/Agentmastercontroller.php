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
    {

        $data['sidebar'] = DB::table('user_permission')->where('uid',session('role'))->get();
        return view('agentmaster',$data);
    }
    public function store(Request $request)//For insert or Update Record Of class Master --
    {
        $ID = $request->save_update;

            $customer   =   Agenmastermodel::updateOrCreate(

                ['id' => $ID],
                [
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
                    'userid'        => 1,
                ]

            );
            $ref_id = $customer->id;

            return $ref_id;

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
}
