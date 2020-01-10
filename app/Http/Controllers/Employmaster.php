<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Employmaster extends Controller
{
    //
    function index(Request $request)
    {


        return view('employmaster');
    }
}
