<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect, Response;
use Illuminate\Support\Facades\DB;
use App\Customermodel;
class Customermasetcontroller extends Controller
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
       $data['activemenu'] ='customer';
        return view('customermaster',$data);
    }
    }
   public function uploadingfile(Request $request){


        $extension = $request->file('file')->getClientOriginalExtension();

        $dir = 'uploads/';
        $filename = uniqid() . '_' . time() . '.' . $extension;

       // echo  dd($filename);
        $request->file('file')->move($dir, $filename);


        return $filename;

    }
    public function store(Request $request)//For insert or Update Record Of class Master --
    {
        $ID = $request->save_update;

        if($ID >0){

            $data = DB::table('customer_master')->where('id', '!=', $ID)->where('email',$request->email)->get();
            $count = count($data);
            if($count >0){
                return '0';
            }else{
                DB::table('customrt_doc')->where('customer_id', $ID)->delete();

                $customer   =   Customermodel::updateOrCreate(

                    ['id' => $ID],
                    [
                        'first_name'        =>  $request->firstname,
                        'last_name'        =>  $request->lastname,
                        'email'        =>  $request->email,
                        'city'        =>  $request->city,
                        'state'        =>  $request->state,
                        'contry'        =>  $request->contry,
                        'pincode'        =>  $request->pincode,
                        'relativename'        =>  $request->relativenm,
                        'mobileno'        =>  $request->mobileno,
                        'address'        =>  $request->address,
                        'cust_profile'        =>  $request->profileimg,
                        'status'        => 1,
                        'user_id'        => $request->session()->get('userid'),
                    ]

                );
                $ref_id = $customer->id;
                $urdata = $request->studejsonObj;

                foreach ($urdata as $value) {


                    $u_rights = array(
                        'customer_id' => $ref_id,
                        'customer_doc' => $value["doctype"],
                        'file' => $value["file"],

                    );

                        $result =  DB::table('customrt_doc')
                        ->Insert($u_rights);
                }

                $urdata = $request->studejsonObj;

                return $ref_id;
            }



        }else{

            $data = DB::table('customer_master')->where('email',$request->email)->get();
            $count = count($data);
            if($count >0){
                return '0';
            }else{
            $customer   =   Customermodel::updateOrCreate(

                ['id' => $ID],
                [
                    'first_name'        =>  $request->firstname,
                    'last_name'        =>  $request->lastname,
                    'email'        =>  $request->email,
                    'city'        =>  $request->city,
                    'state'        =>  $request->state,
                    'contry'        =>  $request->contry,
                    'pincode'        =>  $request->pincode,
                    'relativename'        =>  $request->relativenm,
                    'mobileno'        =>  $request->mobileno,
                    'address'        =>  $request->address,
                    'cust_profile'        =>  $request->profileimg,
                    'status'        => 1,
                    'user_id'        => $request->session()->get('userid'),
                ]

            );
            $ref_id = $customer->id;
            $urdata = $request->studejsonObj;

            foreach ($urdata as $value) {


                $u_rights = array(
                    'customer_id' => $ref_id,
                    'customer_doc' => $value["doctype"],
                    'file' => $value["file"],

                );

                    $result =  DB::table('customrt_doc')
                    ->Insert($u_rights);
            }

            $urdata = $request->studejsonObj;

            return $ref_id;
        }

    }




    }
   public function getallcustomer(){
        $data = DB::table('customer_master')->get();


        return response()->json($data);
    }
    public function editcustomer(Request $request){
        $data = DB::table('customer_master')->where('id',$request->id)->get();


        return response()->json($data);
    }
    public function editdoccustomer(Request $request){
        $data = DB::table('customrt_doc')->where('customer_id',$request->id)->get();


        return response()->json($data);
    }
    public function deletecustomer($id){
        $customer = Customermodel::where('id', $id)->delete();
        DB::table('customrt_doc')->where('customer_id', $id)->delete();
        return Response::json($customer);
    }
    public function uploadingcustfile(Request $request){
        $extension = $request->file('file')->getClientOriginalExtension();

        $dir = 'profile/';
        $filename = uniqid() . '_' . time() . '.' . $extension;

       // echo  dd($filename);
        $request->file('file')->move($dir, $filename);


        return $filename;
    }
    public function updatecustomerinfo(Request $request){
        $updatecust = array(
            'first_name' => $request->firstname,
            'last_name' =>  $request->lastname,
            'email' =>  $request->email,
            'city' =>  $request->city,
            'state' =>  $request->state,
            'contry' =>  $request->contry,
            'pincode' =>  $request->pincode,
            'cust_profile' =>  $request->profileimg,

        );
       $data= DB::table('customer_master')->where('id', $request->save_update)->update($updatecust);
       return $data;
    }
    public function getpaymentinfo(Request $request){
        $id=$request->id;
        $sum=0;
        $paytotal=0;
        $perinfo=0;
        $data= DB::table("ploaalocation_master")->where('c_id',$id)->get();
        foreach($data as $ploatal){
            $amt=$ploatal->amt;
            $sum= $sum+$amt;
            $id=$ploatal->id;

            $data1= DB::table("customer_payment")->where('p_a_id',$id)->get();
            foreach($data1 as $customerp){
                $amt=$customerp->amount;
                $paytotal=$paytotal+$amt;
            }
        }
        if($paytotal >0 &&   $sum >0){
             $perinfo=round(($paytotal*100)/ $sum);
        }

        return $perinfo;



    }
}
