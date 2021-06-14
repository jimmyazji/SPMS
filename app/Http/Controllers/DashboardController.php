<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth;

class DashboardController extends Controller
{
    public function index(){
        $notifications = auth()->user()->notifications;
        return view('dashboard',compact('notifications'));
    }
    public function markNotification(Request $request)
    {
        auth()->user()
        ->unreadNotifications->when($request->input('id'),function($query) use ($request){
            return $query->where('id',$request->input('id'));
        })->markAsRead();
        return response()->noContent();
    }
}
