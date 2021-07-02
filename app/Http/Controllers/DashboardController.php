<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth;

class DashboardController extends Controller
{
    public function index(){
       
        return view('dashboard');
    }
   
}
