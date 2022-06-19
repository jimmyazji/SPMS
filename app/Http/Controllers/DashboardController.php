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
        $readme = Http::accept('application/vnd.github.html')->get('https://api.github.com/repos/SPU-EDU/SPMS/readme')->body();
        return view('dashboard',compact(['readme']));
    }
}
