<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //index
    public function index()
    {
        return view('auth.selection');
    }
    ///dashboard
    public function dashboard()
    {

        return view('dashboard');
    }
}
