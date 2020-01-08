<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect, Response;
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
     function check_login(Request $request)
    {
        return 1;
    }
}
