<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupRequest;
use App\Notifications\GroupJoinRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

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
                return redirect()->route('groups.show', $id)->with('error', 'Please leave your current group before attempting to join another group');
            }
        } else {
            return redirect()->back()->with('error', 'Group is full');
        }
        Notification::send($group->users, new GroupJoinRequestNotification($user, $group));
        return redirect()->back()->with('success', 'Group join request sent');
    }
    public function destroy($group_id)
    {
        GroupRequest::where('sender_id', Auth::id())->where('group_id', $group_id)->delete();
        return redirect()->route('groups.show', $group_id)->with('success', 'Request deleted successfully');
    }
    public function acceptRequest($id)
    {
        $groupRequest = GroupRequest::find($id);
        $sender = $groupRequest->sender;
        $sender->group_id = $groupRequest->group_id;
        $groupRequest->status = 'accepted';
        $sender->update();
        $groupRequest->update();
        return redirect()->back()->with('success','Request accepted successfully');
    }
    public function rejectRequest($id)
    {
        $groupRequest = GroupRequest::find($id);
        $groupRequest->status = 'rejected';
        $groupRequest->update();
        return redirect()->back()->with('success','Request rejected successfully');
    }
}
