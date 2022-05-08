<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Enums\GroupState;
use App\Enums\Specialization;
use App\Models\GroupRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\GroupJoinRequestNotification;

class GroupRequestController extends Controller
{
    public function store($id)
    {
        $group = Group::find($id);
        $user = Auth::user();
        if (!$user->group_id) {
            switch ($group->state) {
                case (GroupState::Full):
                    return redirect()->back()->with('error', 'Group is not taking anymore members!');
                case (GroupState::Invites):
                    return redirect()->back()->with('error', 'Group is not accepting requests currently!');
                default:
                    switch ($user->spec) {
                        case (Specialization::None):
                            return redirect()->back()->with('error', 'Request a specialization before attempting to join a group!');
                        case ($group->type):
                            GroupRequest::firstOrCreate([
                                'group_id' => $id,
                                'sender_id' => $user->id,
                                'status' => 'pending',
                            ]);
                            break;
                        default:
                            return redirect()->back()->with('error', 'Group of type ' . $group->type->value .', your specialization is ' .$user->spec->value.'!');
                    }
            }
        } else {
            return redirect()->back()->with('error', 'Please leave your current group before attempting to join another group!');
        }
        Notification::send($group->users, new GroupJoinRequestNotification($user, $group));
        return redirect()->back()->with('success', 'Group join request sent');
    }
    public function destroy($group_id)
    {
        GroupRequest::where('sender_id', Auth::id())->where('group_id', $group_id)->delete();
        return redirect()->route('groups.show', $group_id)->with('success', 'Request deleted successfully!');
    }
    public function acceptRequest($id)
    {
        $groupRequest = GroupRequest::find($id);
        $sender = $groupRequest->sender;
        if ($sender->group_id != null) {
            $groupRequest->delete();
            return redirect()->back()->with('error', 'User is already in a group');
        } else {
            $sender->group_id = $groupRequest->group_id;
            $groupRequest->status = 'accepted';
            $sender->update();
            $groupRequest->update();
            return redirect()->back()->with('success', $sender->name.' Joined your group successfully!');
        }
    }
    public function rejectRequest($id)
    {
        $groupRequest = GroupRequest::find($id);
        $groupRequest->status = 'rejected';
        $groupRequest->update();
        return redirect()->back()->with('success', 'Request rejected successfully!');
    }
}
