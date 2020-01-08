<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Sitemastercontroller extends Controller
{
    //
    function index(Request $request)
    {


        return view('sitemaster');
    }
}
