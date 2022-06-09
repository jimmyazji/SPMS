<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Enums\GroupState;
use App\Enums\ProjectType;
use App\Enums\Specialization;
use App\Models\GroupRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:group-list|group-create|group-edit|group-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:group-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:group-edit', ['only' => ['edit', 'update']]);
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
        $groups = Group::with('project')
            ->where([
                ['id', '!=', Null],
                [function ($query) use ($request) {
                    if (($term = $request->term)) {
                        $query->orWhere('id', 'LIKE', '%' . $term . '%')
                            ->orWhere('name', 'LIKE', '%' . $term . '%')->load('users')->get();
                    }
                }]
            ])->latest()->paginate(15)->withQueryString();
        return view('groups.index', compact('groups'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $states = GroupState::cases();
        $specs = Specialization::cases();
        $project_types = ProjectType::cases();
        $users = User::role('student')->except(request()->user())->get();
        return view('groups.create', compact('specs', 'users', 'states','project_types'));
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
            'state' => [new Enum(GroupState::class)],
            'type' => [new Enum(Specialization::class)],
            'project_type' => [new Enum(ProjectType::class)],
        ]);
        if(request()->user()->spec === Specialization::None){
            return redirect()->back()->with('error','Request a specialization before creating a group!');
        }
        if (Specialization::from(request()->type) !== Specialization::None){
            if(Specialization::from(request()->type)->name !== request()->user()->spec->name){
                return redirect()->back()->with('error','Cannot create a group of type '.$request->type.'!');
            }
        }
            $user = $request->user();
        $group = Group::create([
            'state' => $request->state,
            'type' => $request->type,
            'project_type' => $request->project_type,
        ]);
        User::where('id', $user->id)->update(['group_id' => $group->id]);
        $user->revokePermissionTo('group-create');
        return redirect()->route('groups.index')
            ->with('success', 'Group created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        $groupRequests = GroupRequest::where('group_id', $group->id)->where('status','pending')->get();
        $requested = $groupRequests->where('sender_id', Auth::id());
        return view('groups.show', compact('group', 'groupRequests', 'requested'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        $states = GroupState::cases();
        $specs = Specialization::cases();
        $users = User::role('student')->get();
        $project_types = ProjectType::cases();
        return view('groups.edit', compact('group', 'users', 'states', 'specs','project_types'));
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
            'state' => [new Enum(GroupState::class)],
            'type' => [new Enum(Specialization::class)],
            'project_type' => [new Enum(ProjectType::class)],
        ]);

        $group->update($request->all());

        return redirect()->route('groups.index')
            ->with('success', 'Group updated successfully');
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
            ->with('success', 'group deleted successfully');
    }
    public function leaveGroup($id)
    {
        $group = Group::find($id);
        if (count($group->users) == 1) {
            $group->delete();
        }
        Auth::user()->update(['group_id' => null]);
        return redirect()->route('groups.index')->with('success', 'Left group successfully');
    }
}
