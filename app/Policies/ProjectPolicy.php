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
        if ($user->group_id != null) {
            if ($user->group->project_id == null) {

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
        if ($user->id == $project->supervisor_id) {
            return true;
        }
        if ($user->group_id) {
            if ($user->group->project_id == $project->id) {
                if ($project->state == ProjectState::Proposition && $project->state != ProjectState::Rejected) {
                    return true;
                }
            }
        }
    }
    public function destroy(User $user, Project $project)
    {
        if ($user->can('project-delete') || $user->group->project_id == $project->id) {
            return true;
        }
    }
    public function complete(User $user, Project $project)
    {
        if ($user->group) {
            if ($user->group->project_id = $project->id && $project->state == ProjectState::Incomplete) {
                return true;
            }
        }
    }
}
