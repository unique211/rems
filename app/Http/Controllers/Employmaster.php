<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect, Response;
use Illuminate\Support\Facades\DB;
use App\Employmastermodel;
use App\Loginmodel;

class Employmaster extends Controller
{
    //
    function index(Request $request)
    {


        return view('employmaster');
    }
    public function store(Request $request)
    {
        $ID = $request->save_update;

        if ($ID > 0) {

            $data = DB::table('employ_master')->where('id', '!=', $ID)->where('email',$request->email)->get();
            $count = count($data);

            if ($count > 0) {
                return response()->json('100');
            }else{
                $data1 = DB::table('employ_master')->where('id', '!=', $ID)->where('mobile_no',$request->mobileno)->get();
                if ($count > 0) {
                    return response()->json('100');
                }else{
                $data = DB::table('login_master')->where('user_name', $request->username)->where('e_id', '!=', $ID)->get();
                $count = count($data);
                if ($count > 0) {
                    return response()->json('101');
                } else {

                    $customer   =   Employmastermodel::updateOrCreate(
                        ['id' => $ID],
                        [
                            'firstname'      =>  $request->firstname,
                            'last_name'        =>  $request->lastname,
                            'email'        =>  $request->email,
                            'mobile_no'        =>  $request->mobileno,
                            'profile_pic'        =>  $request->profilepic,
                            'role'        => $request->role,
                            'status'        => 1,
                            'user_id'        => 1,
                        ]

                    );
                    $ref_id = $customer->id;
                    $str=$request->password;

                    $md5 = md5($str);
                    $password = base64_encode($md5);


                    $customer2   =   Loginmodel::updateOrCreate(
                        ['e_id' => $ref_id],
                        [

                            'e_id'        =>   $ref_id,
                            'user_name'        =>   $request->username,

                            'role'        =>  $request->role,

                        ]);
                        return $ref_id;

                }
            }
            }
        }else{
            $data = DB::table('employ_master')->where('email',$request->email)->orWhere('mobile_no',$request->mobileno)->get();
            $count = count($data);
            if ($count > 0) {
                return response()->json('100');
            }else{

                $data = DB::table('login_master')->where('user_name', $request->username)->get();
                $count = count($data);
                if ($count > 0) {
                    return response()->json('101');
                } else {



                    $customer   =   Employmastermodel::updateOrCreate(
                        ['id' => $ID],
                        [
                            'firstname'      =>  $request->firstname,
                            'last_name'        =>  $request->lastname,
                            'email'        =>  $request->email,
                            'mobile_no'        =>  $request->mobileno,
                            'profile_pic'        =>  $request->profilepic,
                            'role'        =>  $request->role,
                            'status'        => 1,
                            'user_id'        => 1,
                        ]

                    );
                    $ref_id = $customer->id;
                    $str=$request->password;
                    $md5 = md5($str);
                    $password = base64_encode($md5);

                    $customer2   =   Loginmodel::updateOrCreate(
                        ['e_id' => $ref_id],
                        [

                            'e_id'        =>   $ref_id,
                            'user_name'        =>   $request->username,
                            'password'        =>   $password,
                            'role'        =>    $request->role,

                        ]);
                        return $ref_id;
                }
            }
        }
    }
    public function getallemployee(){
        $data = DB::table('employ_master')->get();
        return response()->json($data);
    }
    public function editlogin(Request $request){
        $data = DB::table('login_master')->where('e_id',$request->id)->get();
        return response()->json($data);
    }
    public function deleteemp($id){
        $data = DB::table('employ_master')->where('id',$id)->delete();
         DB::table('login_master')->where('e_id',$id)->delete();


        return response()->json($data);
    }
}
