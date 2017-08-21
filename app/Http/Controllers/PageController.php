<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    // Welcome page or home
    public function index()
    {
        if (Auth::user()) {
            return view('pages.home');
        }
        return view('pages.welcome');
    }

    // User home
    public function home()
    {
        if (Auth::user()){
            return view('pages.home');
        }
        // User not logged in
        return view('pages.welcome');
    }

    // Shows user profile
    public function profile($username)
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            $user = Auth::user();
        }

        return view('pages.account.profile', compact('user'));
    }

}
