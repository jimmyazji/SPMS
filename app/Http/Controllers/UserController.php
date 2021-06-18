<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Dept;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::with('dept')->latest()->filter(request(['search']))
            ->paginate(15)->withQueryString();
        return view('users.index', compact('users'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $depts = Dept::all();
        return view('users.create', compact('roles', 'depts'));
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
            'serial_number' => 'digits:7|unique:users,stdsn',
            'email' => 'required|email|unique:users,email',
            'password' => 'min:8|same:confirm-password',
            'department' => 'required'
        ]);

        $user = User::create([
            'first_name' => ucfirst($request->first_name),
            'last_name' => ucfirst($request->last_name),
            'stdsn' => $request->serial_number,
            'dept_id' => $request->department,
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
            'avatar' => 'default.jpg'
        ]);
        $user->assignRole(explode(',',$request->input('roles')));

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
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        $depts = Dept::all();
        return view('users.edit', compact('user', 'roles', 'userRole', 'depts'));
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
            'stdsn' => 'unique:users,stdsn,'. $id,
            'password' => 'nullable|min:8|same:confirm-password',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:5048'
        ]);
        
        $user = User::find($id);
        
        $input = $request->all();
        if (!empty($input['password'])) {
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'stdsn' => $request->serial_number,
                'dept_id' => $request->department,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } else {
            $input = Arr::except($input, array('password'));
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'stdsn' => $request->serial_number,
                'dept_id' => $request->department,
                'email' => $request->email,
            ]);
        }

        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole(explode(',',$request->input('roles')));

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
