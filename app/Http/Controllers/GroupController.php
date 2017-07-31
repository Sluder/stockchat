<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupController extends Controller
{
    // Page to join or create group
    public function groupView()
    {
        return view("group");
    }

    // Join group from URL
    public function join(Request $request)
    {

    }

    // Create new group (Join from URL)
    public function create(Request $request)
    {

    }

}
