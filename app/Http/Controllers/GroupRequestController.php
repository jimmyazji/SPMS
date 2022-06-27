<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Group;
use App\Enums\GroupState;
use App\Enums\ProjectState;
use App\Models\GroupRequest;
use App\Enums\Specialization;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Notification;
use App\Notifications\GroupJoinRequestNotification;

class GroupRequestController extends Controller
{
    public function store($id)
    {
        $this->authorize('create', GroupRequest::class);
        $group = Group::find($id);
        $user = auth()->user();
        if ($group->developers->contains($user)) {
            return redirect()->back()->withErrors('Already member of this group');
        }

        if (!$user->group) {
            switch ($group->state) {
                case (GroupState::Full):
                    return redirect()->back()->withErrors('Group is not taking anymore members!');
                case (GroupState::Invites):
                    return redirect()->back()->withErrors('Group is not accepting requests currently!');
                default:
                    if ($group->spec != Specialization::None) {
                        switch ($user->spec) {
                            case (Specialization::None):
                                return redirect()->back()->withErrors('Request a specialization before attempting to join a group!');
                            case ($group->spec):
                                GroupRequest::firstOrCreate([
                                    'group_id' => $id,
                                    'sender_id' => $user->id,
                                    'status' => 'pending',
                                ]);
                                break;
                            default:
                                return redirect()->back()->withErrors('Group of type ' . $group->spec->value . ', your specialization is ' . $user->spec->value . '!');
                        }
                    }
            }
        } else {
            return redirect()->back()->withErrors('Please leave your current group before attempting to join another group!');
        }
        Notification::send($group->developers, new GroupJoinRequestNotification($user, $group));
        return redirect()->back()->with('success', 'Group join request sent');
    }
    public function destroy($group_id)
    {
        GroupRequest::where('sender_id', auth()->id())->where('group_id', $group_id)->delete();
        return redirect()->route('groups.show', $group_id)->with('success', 'Request deleted successfully!');
    }
    public function acceptRequest($id)
    {
        $groupRequest = GroupRequest::find($id);
        if ($groupRequest->sender->groups->last()) {
            if (!$groupRequest->sender->groups->last()->project()) {
                $groupRequest->delete();
                return redirect()->back()->withErrors('User is already in a group');
            }
            if (!$groupRequest->sender->groups->last()->project->state == ProjectState::Complete) {
                $groupRequest->delete();
                return redirect()->back()->withErrors('User is already in a group');
            }
        }
        $groupRequest->group->developers()->attach($groupRequest->sender);
        $groupRequest->update(['status' => 'accepted']);
        return redirect()->back()->with('success', $groupRequest->sender->name . ' Joined your group successfully!');
    }
    public function rejectRequest($id)
    {
        $groupRequest = GroupRequest::find($id);
        $groupRequest->status = 'rejected';
        $groupRequest->update();
        return redirect()->back()->with('success', 'Request rejected successfully!');
    }
}
