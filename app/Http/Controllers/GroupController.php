<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    // Page to join or create group
    public function groupMain()
    {
        return view("group-main");
    }

    // Join group from URL
    public function join($key = null, Request $request)
    {
        $user = User::find(1);
        $failed = false;

        // User joining from form
        if ($key === null) {
            if (starts_with($request->get("link"), env("APP_URL"))) {
                $group = Group::where("key", explode(env("APP_URL"), $request->get("link"))[1])->first();

                if ($group !== null) {
                    $user->joinGroup($group->id);
                    //take user to group page
                } else {
                    $failed = true;
                }
            } else {
                $failed = true;
            }
        // User joining from direct URL
        } else {
            $group = Group::where("key", $key)->first();

            if ($group !== null) {
                $user->joinGroup($group->id);
                //take user to group page
            } else {
                $failed = true;
            }
        }

        if ($failed) {
            $request->session()->flash('alert-danger', 'We were unable to find that group. Please ensure the link is correct');
        }
        return view('group-main');
    }

    public function leave(Group $group)
    {
        $user = User::find(1);
        $user->leaveGroup($group->id);

        return redirect()->route('home');
    }

    // Create new group (Join from URL)
    public function create(Request $request)
    {
        // Generate new group key
        $key = substr(uniqid(), 6);
        while (Group::where('key', $key)->first() !== null) {
            $key = substr(uniqid(), 6);
        }

        $group = new Group([
            'name' => $request->get('name'),
            'key' => $key,
            'objective' => $request->get('objective'),
            'creator_id' => User::find(1)->id
        ]);
        $group->save();
    }

}
