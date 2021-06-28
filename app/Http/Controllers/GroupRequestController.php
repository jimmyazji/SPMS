<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupRequestController extends Controller
{
    public function store($id)
    {
        $user = Auth::user();
        if (Group::find($id) != 'full') {
            if (!$user->group_id) {
                GroupRequest::create([
                    'group_id' => $id,
                    'sender_id' => $user->id,
                    'status' => 'pending',
                ]);
            } else {
                return redirect()->back()->with('error', 'Please leave your current group before attempting to join another group');
            }
        } else {
            return redirect()->back()->withErrors('msg', 'Group is full');
        }
        return redirect()->back()->withErrors('msg', 'Group join request sent');
    }
    public function destroy($group_id)
    {
        $requests = GroupRequest::where('user_id',Auth::id())->where('group_id',$group_id);
        dd($requests);
    }
}
