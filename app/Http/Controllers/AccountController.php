<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    // Update users profile information
    public function updateProfile(Request $request)
    {
//        User::update([
//            'name' => $request->get('name'),
//            'email' => $request->get('email'),
//            'username' => $request->get('username'),
//            'username_last_changed' =>  ,
//        ]);
    }

    // Checks if a user exists with username or email
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

}
