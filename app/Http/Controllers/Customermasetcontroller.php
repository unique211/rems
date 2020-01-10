<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect, Response;
class Customermasetcontroller extends Controller
{
    //

    function index(Request $request)
    {

       // $title['activemenu'] = "c";
        return view('customermaster');
    }
    function uploadingfile(Request $request){

        dd($request);
        $extension = $request->file('file')->getClientOriginalExtension();

        $dir = 'uploads/';
        $filename = uniqid() . '_' . time() . '.' . $extension;

       // echo  dd($filename);
        $request->file('file')->move($dir, $filename);


        return $filename;

    }
}
