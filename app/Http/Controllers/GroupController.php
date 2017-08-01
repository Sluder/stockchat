<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
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
        $user = User::find(1);

        if (starts_with($request->get("link"), env("APP_URL"))) {
            $group = Group::where("key", explode(env("APP_URL"), $request->get("link"))[1])->first();

            if ($group !== null) {
                $user->joinGroup($group->id);
            }
        }
    }

    public function leave(Group $group)
    {
        $user = User::find(1);

        $user->leaveGroup($group->id);
    }

    // Create new group (Join from URL)
    public function create(Request $request)
    {
        dd($request->all());
    }

}
