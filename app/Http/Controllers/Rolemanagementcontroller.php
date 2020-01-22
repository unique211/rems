<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect, Response;
use App\Rightmanagementmodel;
class Rolemanagementcontroller extends Controller
{
    //
    function index(Request $request)
    {
        if (!$request->session()->exists('userid')) {
            // user value cannot be found in session
            return redirect('/');
        }else{
        $data['sidebar'] = DB::table('user_permission')->where('uid',session('role'))->get();
        $data['activemenu'] ='rolem';
        return view('rolemanagement',$data);
        }
    }
    public function getallmenu(){
        $result=array();
        $data = DB::table('menu_master')
        ->select('menu_master.*')
        ->get();
        foreach($data as $value){
            $menuid=$value->menu_id;
            $menuname=$value->menuname;
            $submenu=array();
            if($menuid >0){
                $subdata = DB::table('submenu_master')
                ->select('submenu_master.*')
                ->where('menu_id',$menuid)
                ->get();
                $count=count($subdata);
                if($count >0){
                    foreach($subdata as $getsubmenu){
                     $submenu_id=  $getsubmenu->submenu_id;
                     $menu_id=  $getsubmenu->menu_id;
                     $submenuname=  $getsubmenu->submenuname;

                     $submenu[]=array(
                         'submenu_id'=>$submenu_id,
                         'menu_id'=>$menu_id,
                        'submenuname'=>$submenuname,
                     );
                    }
                }

            }
            $result[]=array(
                'menuid'=>$menuid,
                'menu_name'=>$menuname,
                'submenudata'=>$submenu,
            );

        }

        return Response::json($result);
    }
    public function store(Request $request)
    {
        $ID = $request->save_update;

        if($ID >0){
            DB::table('user_permission')->where('uid', $ID)->delete();
        }

        $customer   =   Rightmanagementmodel::updateOrCreate(
            ['id' => $ID],
            [
                'rolename'        =>  $request->rolename,
                'user_id'        => $request->session()->get('userid'),
            ]

        );
        $ref_id = $customer->id;

        $urdata = $request->studejsonObj;
        $u_rights = "";
        $cnt = 0;



        foreach ($urdata as $value) {


            $u_rights = array(
                'uid' => $ref_id,
                'menuid' => $value["menuid"],
                'submenuid' =>$value["submenu"],
                'createright' =>$value["createpermission"],
                'editright' =>$value["editpermission"],
                'deleteright' =>$value["deletepermission"],
                'viewright' =>$value["viewpermission"],

            );
            $result =  DB::table('user_permission')
            ->where('menuid',$value["menuid"])
            ->where('submenuid',$value["submenu"])
            ->where('uid',$ref_id)
            ->get();

            $count=count($result);
            if($count >0){

            }else{
                $result =  DB::table('user_permission')
                ->Insert($u_rights);
            }


            $cnt++;
        }
        return $ref_id;
    }
    public function getallrole(){
        $result =  DB::table('role_master')->get();

        return $result;
    }
    public function getuserright(Request $request){
        $id=$request->id;

        $result =  DB::table('user_permission')->where('uid',$id)->get();

        return $result;
    }
    public function deleterole($id){
        $data = DB::table('role_master')->where('id',$id)->delete();
        DB::table('user_permission')->where('uid',$id)->delete();


        return $data;
    }
}
