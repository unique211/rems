<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Rolemanagementcontroller extends Controller
{
    //
    function index(Request $request)
    {


        return view('rolemanagement');
    }
}
