<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class ProfileController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $id = Auth::id();
        $user = User::find($id);
        if ($user->github_id) {
            try {
                $git = cache()->remember('git' . $id, 21600, fn () => Socialite::driver('github')->userFromToken($user->github_token));
            } catch (Exception) {
                $git = null;
            }
        } else $git = null;
        return view('profile.show', compact('user', 'git'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'stdsn' => 'digits:7|unique:users,stdsn,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|same:confirm-password',
            'avatar' => 'nullable|mimes:jpg,jpeg,png|max:5048'

        ]);
        $input = $request->all();
        if (!empty($input['password'])) {
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } else {
            $input = Arr::except($input, array('password'));
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
            ]);
        }
        return redirect()->route('profile.show')
            ->with('success', 'Profile updated successfully');
    }
}
