<?php

namespace App\Http\Controllers;

use App\Room;
use App\User;
use Validator;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    // Page to join or create group
    public function RoomAdd()
    {
        return view("Room-add");
    }

    // Group page displaying chat
    public function group($key)
    {
        $group = Room::where('key', $key)->first();

        return view('group', compact('group'));
    }

    // Join group from URL
    public function join($key = null, Request $request)
    {
        $user = User::find(1);
        $failed = false;

        // User joining from form
        if ($key === null) {
            if (starts_with($request->get("link"), env("APP_URL"))) {
                $group = Room::where("key", explode(env("APP_URL"), $request->get("link"))[1])->first();

                $group === null ? $failed = true : $user->joinRoom($group->id);
            } else {
                $failed = true;
            }
        // User joining from direct URL
        } else {
            $group = Room::where("key", $key)->first();

            $group === null ? $failed = true : $user->joinRoom($room->id);
        }

        if ($failed) {
            $request->session()->flash('alert-danger', 'We were unable to find that room. Please ensure the link is correct');

            return view('group-add');
        }
        return redirect()->route('group', ['key' => $room->key]);
    }

    public function leave(Room $group)
    {
        $user = User::find(1);
        $user->leaveRoom($group->id);

        return redirect()->route('home');
    }

    // Create new group (Join from URL)
    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), Room::$rules, Room::$messages);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation->messages());
        }

        // Generate new group key
        $key = substr(uniqid(), 6);
        while (Room::where('key', $key)->first() !== null) {
            $key = substr(uniqid(), 6);
        }

        $room = new Room([
            'name' => $request->get('name'),
            'key' => $key,
            'objective' => $request->get('objective'),
            'creator_id' => User::find(1)->id
        ]);
        $room->save();

        User::find(1)->joinRoom($room->id);

        return redirect()->route('room', ['key' => $key]);
    }

}
