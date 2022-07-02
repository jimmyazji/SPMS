<?php

namespace App\Policies;

use App\Enums\ProjectState;
use App\Models\GroupRequest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupRequestPolicy
{
    use HandlesAuthorization;



    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if (!$user->group) {
            return true;
        }
        if (!$user->project) {
            return false;
        }
        if ($user->project->state == ProjectState::Complete) {
        return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupRequest  $groupRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, GroupRequest $groupRequest)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupRequest  $groupRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, GroupRequest $groupRequest)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupRequest  $groupRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, GroupRequest $groupRequest)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupRequest  $groupRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, GroupRequest $groupRequest)
    {
        //
    }
}
