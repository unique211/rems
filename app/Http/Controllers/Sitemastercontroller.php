<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Sitemastermodel;
use Redirect, Response;

class Sitemastercontroller extends Controller
{
    //
   public  function index(Request $request)
    {
        if (!$request->session()->exists('userid')) {
            // user value cannot be found in session
            return redirect('/');
        }else{
        $data['sidebar'] = DB::table('user_permission')->where('uid',session('role'))->get();
        $data['activemenu'] ='sitem';
        return view('sitemaster',$data);
        }
    }

    public function store(Request $request)//For insert or Update Record Of class Master --
    {
        $ID = $request->save_update;

        if($ID >0){
            //DB::table('plot_detalis')->where('site_id', $ID)->delete();
        }

            $customer   =   Sitemastermodel::updateOrCreate(

                ['id' => $ID],
                [
                    'site_name'        =>  $request->sitename,
                    'area_name'        =>  $request->areaname,
                    'total_ploat'        =>  $request->noofploats,
                    'total_areaof_ploats'=> $request->totalarea,
                    'user_id'        => $request->session()->get('userid'),
                ]

            );
            $ref_id = $customer->id;
            $urdata = $request->studejsonObj;

            foreach ($urdata as $value) {
                if($ID >0){
                    //DB::table('plot_detalis')->where('site_id', $ID)->delete();
                    $spid=$value["srpid"];
                    if($spid >0){
                        $u_rights = array(
                            'site_id' => $ref_id,
                            'plots_no' => $value["ploatno"],
                            'area_insqft' => $value["areainsqft"],
                            'persqftrate' => $value["persqftrate"],
                            'cost' => $value["cost"],

                        );
                        $result =  DB::table('plot_detalis')->where('id', $spid)->where('site_id', $ref_id)
                            ->update($u_rights);
                    }else{
                        $u_rights = array(
                            'site_id' => $ref_id,
                            'plots_no' => $value["ploatno"],
                            'area_insqft' => $value["areainsqft"],
                            'persqftrate' => $value["persqftrate"],
                            'cost' => $value["cost"],

                        );
                        $result =  DB::table('plot_detalis')
                            ->Insert($u_rights);
                    }

                }else{
                    $u_rights = array(
                        'site_id' => $ref_id,
                        'plots_no' => $value["ploatno"],
                        'area_insqft' => $value["areainsqft"],
                        'persqftrate' => $value["persqftrate"],
                        'cost' => $value["cost"],

                    );

                        $result =  DB::table('plot_detalis')
                        ->Insert($u_rights);
                }


            }

            $urdata = $request->studejsonObj;

            return $ref_id;

    }
    public function getallsites(){
        $data = DB::table('site_master')->get();
        return response()->json($data);
    }
    public function editplotsdetalis(Request $request){
        $data = DB::table('plot_detalis')->where('site_id',$request->id)->get();
         return response()->json($data);
    }
    public function deletesite($id){
        $customer = Sitemastermodel::where('id', $id)->delete();
        DB::table('plot_detalis')->where('site_id', $id)->delete();
        return Response::json($customer);
    }
}
