<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Group;
use App\Enums\GroupState;
use App\Enums\ProjectType;
use App\Models\GroupRequest;
use Illuminate\Http\Request;
use App\Enums\Specialization;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;
use Laravel\Socialite\Facades\Socialite;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:group-list', ['only' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $groups = Group::with('project','developers')
            ->filter(request(['search']))->latest()->paginate(15)->withQueryString();
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
        $this->authorize('create', Group::class);
        $states = GroupState::cases();
        $specs = Specialization::cases();
        $project_types = ProjectType::cases();
        $users = User::role('student')->except(request()->user())->get();
        return view('groups.create', compact('specs', 'users', 'states', 'project_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Group::class);
        if (request()->user()->spec === Specialization::None) {
            return redirect()->back()->with('error', 'Request a specialization before creating a group!');
        }
        try {
            Socialite::driver('github')->userFromToken(auth()->user()->github_token);
        } catch (Exception) {
            return redirect()->back()->withErrors('Make sure you\'ve linked your github account before creating a group!')->withInput();
        }
        $this->validate($request, [
            'state' => [new Enum(GroupState::class)],
            'spec' => [new Enum(Specialization::class)],
            'project_type' => [new Enum(ProjectType::class)],
        ]);
        if (Specialization::from(request()->spec) !== Specialization::None) {
            if (Specialization::from(request()->spec)->name !== request()->user()->spec->name) {
                return redirect()->back()->withError('Cannot create a group of specialization ' . $request->spec . '!')->withInput();
            }
        }
        $group = Group::create([
            'state' => $request->state,
            'spec' => $request->spec,
            'project_type' => $request->project_type,
        ]);
        $request->user()->groups()->attach($group);

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
        $groupRequests = GroupRequest::where('group_id', $group->id)->where('status', 'pending')->get();
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
        $this->authorize('edit', $group);
        $states = GroupState::cases();
        $specs = Specialization::cases();
        $users = User::role('student')->get();
        $project_types = ProjectType::cases();
        return view('groups.edit', compact('group', 'users', 'states', 'specs', 'project_types'));
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
        $this->authorize('edit', $group);
        $this->validate($request, [
            'state' => [new Enum(GroupState::class)],
            'spec' => [new Enum(Specialization::class)],
            'project_type' => [new Enum(ProjectType::class)],
        ]);
        if (Specialization::from(request()->spec) !== Specialization::None) {
            if (Specialization::from(request()->spec)->name !== request()->user()->spec->name) {
                return redirect()->back()->withError('Cannot create a group of specialization ' . $request->spec . '!')->withInput();
            }
        }
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
        $this->authorize('destroy', $group);
        $group->delete();
        return redirect()->route('groups.index')
            ->with('success', 'group deleted successfully');
    }
    public function leaveGroup($id)
    {
        $group = Group::find($id);
        if (count($group->developers) == 1) {
            $group->delete();
        }
        $group->developers()->detach(auth()->user());
        return redirect()->route('groups.index')->with('success', 'Left group successfully');
    }
}
