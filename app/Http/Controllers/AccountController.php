<?php

namespace App\Http\Controllers;

use App\Settings;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class AccountController extends Controller
{
    // Update users profile information
    public function updateProfile(Request $request)
    {
        $validation = Validator::make($request->all(), User::$update_rules);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation->messages(), 'update_errors');
        }

        // Check if user is able to change username
        if (strtotime(Auth::user()->username_last_changed) < strtotime('-30 days') && $request->has('username')) {
            $username = $request->get('username');
        } else {
            $username = NULL;
        }

        // Update user and user settings
        Auth::user()->update([
            'id' => Auth::id(),
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'username' => $username === NULL ? Auth::user()->username : $username,
            'username_last_changed' =>  $username === NULL ? Auth::user()->username_last_changed : date("Y-m-d H:i:s"),
        ]);

        Settings::find(Auth::user()->settings_id)->update([
            'skill_level' => $request->get('skill_level')
        ]);

        return redirect()->route('profile', ['username' => Auth::user()->username])->with('account-message', 'Your profile was successfully updated!');
    }

    // Update user password
    public function updatePassword(Request $request)
    {
        $validation = Validator::make($request->all(), User::$password_rules);
        if ($validation->fails() || ($request->get('password') !== $request->get('password_repeat'))) {
            return redirect()->back()->withInput()->withErrors($validation->messages(), 'password_errors');
        }

        if (!Hash::check($request->get('password_old'), Auth::user()->password)) {
            return redirect()->back()->withInput()->with('password_error', 'Old password is incorrect.');
        }

        Auth::user()->update([
            'id' => Auth::id(),
            'password' =>  Hash::make($request->get('password'))
        ]);

        return redirect()->route('profile', ['username' => Auth::user()->username])->with('password_message', 'Password was successfully updated!');
    }

    // (AJAX) Checks if a user exists with username or email
    public function checkAvailability($data)
    {
        return response()->json(User::where('username', 'LIKE', '%' . $data . '%')->orWhere('email', $data)->exists());
    }

    // Auth user follows another user
    public function follow(User $user)
    {
        Auth::user()->follow($user->id);

        return redirect()->route('profile', ['username' => $user->username]);
    }

    // Auth user unfollows another user
    public function unfollow(User $user)
    {
        Auth::user()->unfollow($user->id);

        return redirect()->route('profile', ['username' => $user->username]);
    }

    // (AJAX) Get $page num paginated list of accounts user is following
    public function getFollowing($page)
    {
        return Auth::user()->following()->paginate(3, ['*'], 'page', $page);
    }

}
