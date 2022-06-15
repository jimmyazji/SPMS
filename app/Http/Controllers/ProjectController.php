<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Enums\ProjectType;
use App\Enums\ProjectState;
use Illuminate\Http\Request;
use App\Enums\Specialization;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
        $this->middleware('permission:project-list|project-create|project-edit|project-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:project-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:project-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:project-delete', ['only' => ['destroy']]);
        $this->middleware('permission:project-supervise', ['only' => ['supervise','unsupervise']]);
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
        $specs = Specialization::cases();
        $types = ProjectType::cases();
        $states = ProjectState::cases();
        return view('projects.create', compact(['specs', 'types', 'states']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:projects,title',
            'type' => [new Enum(ProjectType::class)],
            'spec' => [new Enum(Specialization::class)],
            'aims' => 'required|array|min:1',
            'aims.*' => 'required|string',
            'objectives' => 'required|array|min:1',
            'objectives.*' => 'required|string',
            'tasks' => 'required|array|min:1',
            'tasks.*' => 'required|string',
        ]);

        $project = Project::create([
            'title' => $request->title,
            'type' => $request->type,
            'spec' => $request->spec,
            'aims' => json_encode($request->aims),
            'objectives' => json_encode($request->objectives),
            'tasks' => json_encode($request->tasks),
            'supervisor_id' => $request->supervise
        ]);

        if ($request->user()->group) {
            $request->user()->group->update(['project_id' => $project->id]);
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
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $specs = Specialization::cases();
        $types = ProjectType::cases();
        $states = ProjectState::cases();
        $project = Project::find($id);
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
        $project = Project::find($id);
        $project->update([
            'title' => $request->title,
            'type' => $request->type,
            'spec' => $request->spec,
            'aims' => json_encode($request->aims),
            'objectives' => json_encode($request->objectives),
            'tasks' => json_encode($request->tasks),
            'supervisor_id' => $request->supervise
        ]);
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
        Project::find($id)->delete();
        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully');
    }
    public function assignProject($id)
    {
        $project = Project::find($id);
        if (Auth::user()->group) {
            $group = Auth::user()->group;
            if ($group->project_id) {
                return redirect()->back()->with('error', 'You need to abandon your current project before assigning a new one');
            } else {
                if (!$project->group) {
                    $group->project_id = $project->id;
                    $group->update();
                    return redirect()->back()->with('success', 'Project assigned successfully');
                }
            }
        } else {
            return redirect()->back()->with('error', 'You need to join a group before assigning a project');
        }
    }
    public function unAssignProject($id)
    {

        Project::find($id)->group()->update(['project_id' => null]);
        return redirect()->back()->with('success', 'Group unassigned successfully');
    }
    public function supervise($id)
    {
        Project::find($id)->update(['supervisor_id' => request()->user()->id]);
        return redirect()->back()->with('success','Assigned supervisor');
    }
    public function unsupervise($id)
    {
        Project::find($id)->update(['supervisor_id' => null]);
        return redirect()->back()->with('success','Assigned supervisor');
    }
}
