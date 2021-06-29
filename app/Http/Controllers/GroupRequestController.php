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
        $group = Group::find($id);
        $user = Auth::user();
        if ($group->status != 'Full') {
            if (!$user->group_id) {
                GroupRequest::create([
                    'group_id' => $id,
                    'sender_id' => $user->id,
                    'status' => 'pending',
                ]);
            } else {
                return redirect()->route('groups.show',$id)->with('error','Please leave your current group before attempting to join another group');
            }
        } else {
            return redirect()->back()->with('error', 'Group is full');
        }
        return redirect()->back()->with('success', 'Group join request sent');
    }
    public function destroy($group_id)
    {
        GroupRequest::where('sender_id',Auth::id())->where('group_id',$group_id)->delete();
        return redirect()->route('groups.show',$group_id)->with('success','Request deleted successfully');
    }
}
