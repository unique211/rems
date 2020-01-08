<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Agentmastercontroller extends Controller
{
    //
    function index(Request $request)
    {


        return view('agentmaster');
    }
}
