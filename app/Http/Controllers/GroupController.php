<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;



class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:group-list|group-create|group-edit|group-delete', ['only' => ['index','show']]);
         $this->middleware('permission:group-create', ['only' => ['create','store']]);
         $this->middleware('permission:group-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:group-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        if ($user->dept_id = 1)
        {
            $groups = Group::with('project')
            ->where([
                ['id','!=',Null],
                [function ($query) use ($request){
                    if (($term = $request->term)){
                        $query->orWhere('id' , 'LIKE' , '%' . $term . '%')
                        ->orWhere('name' , 'LIKE' , '%' . $term . '%')->load('users')->get();
                    }
                }]
            ])->latest()->paginate(15)->withQueryString();
        }
        else
        {
            $search = $user->dept_id;
            $groups = Group::with('project')->where('dept_id','=',$search)
            ->where([
                ['id','!=',Null],
                [function ($query) use ($request){
                    if (($term = $request->term)){
                        $query->orWhere('id' , '=', $term)->load('users')->get();
                    }
                }]
            ])->latest()->paginate(15)->withQueryString();
        }
        return view('groups.index',compact('groups'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = $request->user();
        if ($user->dept_id = 1){
            $projects = Project::where('taken','=',0)->get();
            $users = User::where('group_id','=',NULL)->get();
        }
        else {
            $term = $user->dept_id;
            $projects = Project::where('dept_id','=', $term)
            ->where('taken','=',0)->get();
            $users = User::where('dept_id','=',$term)
            ->where('group_id','=',NULL)->get();
        }
        return view('groups.create',compact('projects','users'));
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
            'status' => 'required',
        ]);

        $user = $request->user();
        $dept_id = $user->dept_id;
        $group = Group::create([
            'dept_id' => $dept_id,
            'status' => $request->status,
            'project_id' => $request->project_id,
        ]);
        User::where('id',$user->id)->update(['group_id'=>$group->id]);
        $user->revokePermissionTo('group-create');
        return redirect()->route('groups.index')
                        ->with('success','Group created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = Group::find($id);
        return view('groups.show',compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        $projects = Project::where('taken','=',0)->get();
        $users = User::where('group_id','=',NULL)->get();
        return view('groups.edit',compact('group','projects','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);

        $group->update($request->all());

        return redirect()->route('groups.index')
                        ->with('success','Group updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $group->delete();

        return redirect()->route('groups.index')
                        ->with('success','group deleted successfully');
    }
}
