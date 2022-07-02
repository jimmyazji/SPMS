<?php

namespace App\Policies;

use App\Enums\GroupState;
use App\Enums\ProjectState;
use App\Models\User;
use App\Models\Group;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        if ($user->can('group-create') && $user->groups->isEmpty()) {
            return true;
        }
        if ($user->group) {
            if ($user->project->state == ProjectState::Complete) {
                return true;
            }
        }
    }
    public function edit(User $user, Group $group)
    {
        if ($user->can('group-edit') || $user->group == $group) {
            return true;
        }
    }
    public function destroy(User $user, Group $group)
    {
        if ($user->can('group-delete') || $user->group == $group) {
            return true;
        }
    }
}
