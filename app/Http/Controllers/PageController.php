<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    // Index
    public function home()
    {
        return view('home');
    }

}
