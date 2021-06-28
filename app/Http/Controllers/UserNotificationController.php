<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserNotificationController extends Controller
{
    public function show($id)
    {
        $notification = auth()->user()->notifications->where('id', $id)->first();
        if ($notification) {
            $notification->markAsRead();
            return redirect($notification->data['link']);
        }
    }
    
    public function markAllRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
