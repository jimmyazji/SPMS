<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Project;
use App\Enums\ProjectType;
use App\Enums\ProjectState;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Enums\Specialization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules\Enum;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:project-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:project-supervise', ['only' => ['supervise', 'unsupervise']]);
        $this->middleware('permission:project-approve', ['only' => ['approve', 'disapprove']]);
    }
    public function index(Request $request)
    {
        $specs = Specialization::cases();
        $types = ProjectType::cases();
        $states = ProjectState::cases();
        $projects = Project::with('group')->latest()->filter(request(['search', 'spec', 'type', 'state', 'created_from', 'created_to', 'updated_from', 'updated_to']))
            ->paginate(10)->withQueryString();
        return view('projects.index', compact(['projects', 'specs', 'types', 'states']))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Project::class);
        $repos = Http::get('https://api.github.com/orgs/SPU-EDU/repos')->json();
        $specs = Specialization::cases();
        $types = ProjectType::cases();
        $states = ProjectState::cases();
        return view('projects.create', compact(['specs', 'types', 'states', 'repos']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Project::class);
        $group = $request->user()->group;
        $this->validate($request, [
            'title' => 'required|unique:projects,title',
            'type' => [new Enum(ProjectType::class)],
            'spec' => [new Enum(Specialization::class)],
            'state' => [new Enum(ProjectState::class)],
            'aims' => 'required|array|min:1',
            'aims.*' => 'required|string',
            'objectives' => 'required|array|min:1',
            'objectives.*' => 'required|string',
            'tasks' => 'required|array|min:1',
            'tasks.*' => 'required|string',
        ]);
        if (!$request->repo) {
            $response = Http::withToken('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')->post('https://api.github.com/orgs/SPU-EDU/repos', [
                'name' => Str::slug($request->title),
                'private' => false,
            ]);
            $new_repo = $response->json('url');
        }
        $project = Project::create([
            'title' => $request->title,
            'url' => $request->repo ?? $new_repo,
            'type' => $request->user()->can('project-create') ? $request->type : $group->project_type,
            'spec' => $request->user()->can('project-create') ? $request->spec : $group->spec,
            'state' => $request->user()->can('project-approve') ? $request->state : ProjectState::Proposition,
            'aims' => json_encode($request->aims),
            'objectives' => json_encode($request->objectives),
            'tasks' => json_encode($request->tasks),
            'supervisor_id' => $request->supervise
        ]);

        if ($group) {
            $group->update(['project_id' => $project->id]);
        }

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::with('group', 'supervisor', 'developers')
            ->find($id);
        $github = Http::withToken('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')->get($project->url)->json();
        $markdown = ($project->url != null) ? Http::withToken('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')->accept('application/vnd.github.html')->get($project->url . '/readme')->body() : '';
        $languages = collect(Http::withToken('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')->get($github['languages_url'])->json());
        $updated_at = $github['updated_at'];
        if (Carbon::parse($updated_at) >= Carbon::parse($project->updated_at)) {
            $project->update(['updated_at' => $updated_at]);
        };
        return view('projects.show', compact('project', 'markdown', 'github', 'languages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        $this->authorize('edit', $project);
        $specs = Specialization::cases();
        $types = ProjectType::cases();
        $states = ProjectState::cases();
        return view('projects.edit', compact(['project', 'specs', 'types', 'states']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::find($id);
        $this->authorize('edit', $project);
        $this->validate($request, [
            'title' => 'required|unique:projects,title,' . $id,
            'type' => [new Enum(ProjectType::class)],
            'spec' => [new Enum(Specialization::class)],
            'aims' => 'required|array|min:1',
            'aims.*' => 'required|string',
            'objectives' => 'required|array|min:1',
            'objectives.*' => 'required|string',
            'tasks' => 'required|array|min:1',
            'tasks.*' => 'required|string',
        ]);
        if ($request->user()->can('project-approve')) {
            $project->update([
                'title' => $request->title,
                'type' => $request->type,
                'spec' => $request->spec,
                'state' => $request->state,
                'aims' => json_encode($request->aims),
                'objectives' => json_encode($request->objectives),
                'tasks' => json_encode($request->tasks),
                'supervisor_id' => $request->supervise,
            ]);
        } else {
            $project->update([
                'title' => $request->title,
                'type' => $request->type,
                'spec' => $request->spec,
                'aims' => json_encode($request->aims),
                'objectives' => json_encode($request->objectives),
                'tasks' => json_encode($request->tasks),
                'supervisor_id' => $request->supervise,
            ]);
        }
        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $this->authorize('destroy', $project);
        $project->delete();
        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully');
    }
    public function assignProject($id)
    {
        $project = Project::find($id);
        if (!Auth::user()->group) {
            return redirect()->back()->with('error', 'You need to join a group before assigning a project');
        }
        $group = Auth::user()->group;
        if ($group->project_id) {
            return redirect()->back()->with('error', 'You need to abandon your current project before assigning a new one');
        }
        if ($project->group ?? false) {
            return redirect()->back()->with('error', 'A group is already assigned to this project');
        }
        if ($project->spec != Specialization::None && $project->spec != $group->spec) {
            return redirect()->back()->with('error', 'This project is not for your group\'s specialization');
        }
        if ($project->type != $group->project_type) {
            return redirect()->back()->with('error', 'This project is for ' . $project->type->value . ' only');
        }
        $group->update(['project_id' => $project->id]);
        if ($project->supervisor_id) {
            $project->update(['state' => ProjectState::Approving]);
        }
        return redirect()->back()->with('success', 'Project assigned successfully');
    }
    public function unAssignProject($id)
    {

        $project = Project::find($id);
        if (!$project->supervisor_id) {
            $project->delete();
            return redirect()->route('projects.index')->with('success', 'Group unassigned successfully');
        }
        $project->group()->update(['project_id' => null]);
        $project->update(['state' => ProjectState::Proposition]);
        return redirect()->back()->with('success', 'Group unassigned successfully');
    }
    public function supervise($id)
    {
        $project = Project::find($id);
        $project->update(['supervisor_id' => request()->user()->id]);
        if ($project->group() ?? false) {
            $project->update(['state' => ProjectState::Approving]);
        }
        return redirect()->back()->with('success', 'Assigned supervisor successfully');
    }
    public function unsupervise($id)
    {
        Project::find($id)->update(['supervisor_id' => null, 'state' => ProjectState::Proposition]);
        return redirect()->back()->with('success', 'Unassigned supervisor successfully');
    }
    public function approve(Project $project)
    {
        switch ($project->state) {
            case (ProjectState::Incomplete):
                $project->update(['state' => ProjectState::Complete]);
                break;
            case (ProjectState::Evaluating):
                $project->update(['state' => ProjectState::Complete]);
                break;
            default:
                $project->update(['state' => ProjectState::Incomplete]);
        }
        return redirect()->back()->with('success', 'Project approved successfully');
    }

    public function disapprove(Project $project)
    {
        $project->update(['state' => ProjectState::Rejected]);
        return redirect()->back()->with('success', 'Project rejected successfully');
    }

    public function complete(Project $project)
    {
        $this->authorize('complete', $project);
        $project->update(['state' => ProjectState::Evaluating]);
        return redirect()->back()->with('success', 'Project state set to evaluating successfully');
    }
}
