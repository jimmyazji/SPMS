<?php

namespace App\Policies;

use App\Enums\ProjectState;
use App\Models\User;
use App\Models\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        if ($user->group != null) {
            if ($user->project_id == null) {

                return true;
            }
        }
        if ($user->can('project-create')) {
            return true;
        }
    }
    public function edit(User $user, Project $project)
    {
        if ($user->can('project-edit')) {
            return true;
        }
        if ($project->supervisor->id == $user->id) {
            return true;
        }
        if ($user->group) {
            if ($user->project == $project) {
                if ($project->state == ProjectState::Proposition && $project->state != ProjectState::Rejected) {
                    return true;
                }
            }
        }
    }
    public function destroy(User $user, Project $project)
    {
        if ($user->can('project-delete') || $user->project_id == $project->id) {
            return true;
        }
    }
    public function complete(User $user, Project $project)
    {
        if ($project->state != ProjectState::Incomplete) {
            return false;
        }
        if ($user->groups()->latest()) {
            if (($user->project = $project) && ($project->state == ProjectState::Incomplete)) {
                return true;
            }
        }
        if ($project->supervisor_id && $project->supervisor = $user) {
            return true;
        }
    }
    public function export(User $user)
    {
        return $user->can('project-export');
    }
    public function sync(User $user,Project $project)
    {
        if ($user->can('project-approve')) return true;
        if ($user->group) {
            if ($user->group->project == $project) {
                return true;
            }
        }
        if($user->id = $project->supervisor_id) return true;
    }
}
