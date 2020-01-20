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
        $data['activemenu'] ='acreport';
        return view('remainploats',$data);
        }
    }
    public function getremainploatsdata(Request $request){

        // $data = DB::table('plot_detalis')
        // ->join('site_master', 'site_master.id', '=', 'plot_detalis.site_id')
        // ->join('login_master', 'login_master.id', '=', 'site_master.user_id');
        // if($request->sitenm >0){
        //     $data = $data  ->where('site_master.id',$request->sitenm);
        // }

        // //last changes here
        // $data =$data->select('plot_detalis.*', 'site_master.site_name as site_name','login_master.user_name')
        // ->get();
        // //last changes here


    }
}
