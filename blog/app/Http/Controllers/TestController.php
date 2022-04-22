<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    function about(){
        $ab = "welcome to about page";
        return view('pages.about', compact('ab'));
    }
}
