<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect, Response;
use Illuminate\Support\Facades\DB;
class LoginController extends Controller
{
    //

   function index(Request $request)
    {
        if ($request->session()->exists('userid')) {
            $request->session()->flush();
        }

        return view('login');
    }


        public function check_login(Request $request)
        {


            //return view('user_manage');
            $user_id = $request->username;



            $str = $request->password;
            $md5 = md5($str);
            $password = base64_encode($md5);
            $msg = 0;



            $user = DB::table('login_master')
                ->select('login_master.*')
                ->where('user_name', $user_id)
                ->where('password', $password)
                ->get();

            $cnt = count($user);



            if ($cnt > 0) {
                $get_password = "";
                $get_user_id = "";
                $get_role = "";
                $get_id = "";
                $ref_id = "";
                $msg = 1;

                foreach ($user as $user1) {
                    $get_password =  $user1->password;
                    $get_user_id =  $user1->id;
                    $get_role =  $user1->role;
                    $get_id =  $user1->e_id;
                    $ref_id =  $user1->id;

                }

                $request->session()->put('userid',  $get_user_id);
                $request->session()->put('role',  $get_role);
                $request->session()->put('eid',  $get_id);
               // $request->session()->put('user_name',  $user_name);


            }

            return $msg;
            // //   return Response::json($msg);
        }

}
