<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect, Response;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    //
    function index(Request $request)
    {
    $data['sidebar'] = DB::table('user_permission')->where('uid',session('role'))->get();
          return view('dashboard',$data);
    }
}
