<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
    }
    public function index(Request $request)
    {
        $user = $request->user();
        if ($user->dept_id = 1) {
            $projects = Project::with('dept')
                ->where([
                    ['title', '!=', Null],
                    [function ($query) use ($request) {
                        if (($term = $request->term)) {
                            $query->orWhere('title', 'LIKE', '%' . $term . '%')
                                ->orWhere('description', 'LIKE', '%' . $term . '%')->get();
                        }
                    }]
                ])->latest()->paginate(15)->withQueryString();
        } else {
            $term1 = $user->dept_id;
            $groups = Project::with('dept')->where('dept_id', '=', $term1)->latest()->paginate(5)->withQueryString();
        }
        return view('projects.index', compact('projects'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
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
            'title' => 'required',
            'type' => 'required',
            'description' => 'min:20|max:255'
        ]);
        if ($request->supervise == true) {
            $user = $request->user();
            $dept_id = $user->dept_id;
            $project = Project::create([
                'title' => $request->title,
                'type' => $request->type,
                'description' => $request->description,
                'dept_id' => $dept_id,
                'supervisor_id' => $user->id,
                'taken' => false
            ]);
        } else {
            $user = $request->user();
            $dept_id = $user->dept_id;

            $project = Project::create([
                'title' => $request->title,
                'type' => $request->type,
                'description' => $request->description,
                'dept_id' => $dept_id,
                'taken' => false
            ]);
        }
        $user->group->project_id = $project->id;
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
        $project = Project::with('group', 'supervisor', 'dept', 'users')
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
        $project = Project::find($id);
        return view('projects.edit', compact('project'));
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
            'title' => 'required',
            'type' => 'required',
            'description' => 'min:20|max:255'
        ]);
        $project = Project::find($id);
        $user = $request->user();
        if ($request->supervise == true) {
            $project->update([
                'title' => $request->title,
                'type' => $request->type,
                'description' => $request->description,
                'supervisor' => $user->id,
            ]);
        } else {
            $project->update([
                'title' => $request->title,
                'type' => $request->type,
                'description' => $request->description,
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
    public function unAssignProject()
    {
        Auth::user()->group->update(['project_id' => null]);
        return redirect()->back()->with('success','Group unassigned successfully');
    }
}
