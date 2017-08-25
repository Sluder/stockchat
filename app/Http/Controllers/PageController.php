<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    // Welcome page or home
    public function index()
    {
        if (Auth::check()) {
            return view('pages.home');
        }
        return view('pages.welcome');
    }

    // User home
    public function home()
    {
        if (Auth::check()){
            return view('pages.home');
        }
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

    // Login view
    public function loginShow()
    {
        return view('pages.account.login');
    }

    // Join or create a room
    public function roomAdd()
    {
        return view("pages.rooms.room-add");
    }

}
