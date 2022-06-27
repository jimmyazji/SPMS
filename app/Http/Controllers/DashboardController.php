<?php

namespace App\Http\Controllers;

use Illuminate\Mail\Markdown;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}
