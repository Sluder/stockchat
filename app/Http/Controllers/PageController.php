<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    // User home
    public function home()
    {
        if (Auth::user()){
            return view('pages.home');
        }
        // User not logged in
        return view('pages.home-default');
    }

}
