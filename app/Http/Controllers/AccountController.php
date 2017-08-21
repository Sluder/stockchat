<?php

namespace App\Http\Controllers;

use App\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    // Login/sign-up view
    public function loginShow()
    {
        return view('pages.account.login');
    }

    // Update users profile information
    public function updateProfile(Request $request)
    {
        dd($request->all());
    }

    // Logged in user follows another user
    public function follow(User $user)
    {
        Auth::user()->follow($user->id);

        return redirect()->route('profile', ['username' => $user->username]);
    }

    // Logged in user unfollows another user
    public function unfollow(User $user)
    {
        Auth::user()->unfollow($user->id);

        return redirect()->route('profile', ['username' => $user->username]);
    }

}
