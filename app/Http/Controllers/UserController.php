<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Enums\Specialization;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules\Enum;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $users = User::with('roles')->latest()->filter(request(['search', 'spec']))
            ->paginate(10)->withQueryString();
        $specs = Specialization::cases();
        $roles = Role::pluck('name', 'name')->all();
        return view('users.index', compact('users', 'specs', 'roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specs = Specialization::cases();
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles', 'specs'));
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
            'first_name' => 'required',
            'last_name' => 'required',
            'serial_number' => 'nullable|digits:7|unique:users,stdsn',
            'spec' => [new Enum(Specialization::class)],
            'email' => 'required|email|unique:users,email',
            'password' => 'min:8|same:confirm-password',
        ]);
        $user = User::create([
            'first_name' => ucwords(strtolower($request->first_name)),
            'last_name' => ucwords(strtolower($request->last_name)),
            'stdsn' => $request->serial_number,
            'spec' => $request->spec,
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
            'avatar' => 'default.jpg'
        ]);
        if ($request->roles) {
            Http::withToken(env('GITHUB_TOKEN'))->post(env('GITHUB_ORG').'/invitations', ['email' => $user->email ,'role' => 'direct_member']);
        }
        $user->assignRole($request->roles);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if ($user->github_id) {
            try {
                $git = Socialite::driver('github')->userFromToken($user->github_token);
            } catch (Exception) {
                $git = null;
            }
        } else $git = null;
        return view('users.show', compact('user', 'git'));
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
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('users.edit', compact('user', 'roles', 'userRole', 'specs'));
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'stdsn' => 'unique:users,stdsn,' . $id,
            'spec' => [new Enum(Specialization::class)],
            'password' => 'nullable|min:8|same:confirm-password',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:5048'
        ]);
        $user = User::find($id);
        $input = $request->all();
        if (!empty($input['password'])) {
            $user->update([
                'first_name' => ucwords(strtolower($request->first_name)),
                'last_name' => ucwords(strtolower($request->last_name)),
                'stdsn' => $request->serial_number,
                'spec' => $request->spec,
                'email' => strtolower($request->email),
                'password' => Hash::make($request->password),
            ]);
        } else {
            $input = Arr::except($input, array('password'));
            $user->update([
                'first_name' => ucwords(strtolower($request->first_name)),
                'last_name' => ucwords(strtolower($request->last_name)),
                'stdsn' => $request->serial_number,
                'spec' => $request->spec,
                'email' => strtolower($request->email),
            ]);
        }
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->roles);
        if ($request->roles) {
            Http::withToken(env('GITHUB_TOKEN'))->post(env('GITHUB_ORG').'/invitations', ['email' => $user->email ,'role' => 'direct_member']);
        }
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
