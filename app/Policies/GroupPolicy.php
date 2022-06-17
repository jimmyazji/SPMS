<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Group;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        if ($user->can('group-create') && $user->group_id == null) {
            return true;
        }
    }
    public function edit(User $user, Group $group)
    {
        if ($user->can('group-edit') || $user->group_id == $group->id) {
            return true;
        }
    }
    public function destroy(User $user, Group $group)
    {
        if ($user->can('group-delete') || $user->group_id == $group->id) {
            return true;
        }
    }
}
