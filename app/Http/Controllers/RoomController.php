<?php

namespace App\Http\Controllers;

use App\Room;
use App\User;
use Validator;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    // Page to join or create room
    public function roomShow()
    {
        return view("pages.rooms.room-add");
    }

    // Room page displaying chat
    public function room($key)
    {
        $room = Room::where('key', $key)->first();

        return view('pages.rooms.room', compact('room'));
    }

    // Join room from URL
    public function join($key = null, Request $request)
    {
        $user = User::find(1);
        $failed = false;

        // User joining from form
        if ($key === null) {
            if (starts_with($request->get("link"), env("APP_URL"))) {
                $room = Room::where("key", explode(env("APP_URL"), $request->get("link"))[1])->first();
                $room === null ? $failed = true : $user->joinRoom($room->id);
            } else {
                $failed = true;
            }
        // User joining from direct URL
        } else {
            $room = Room::where("key", $key)->first();
            $room === null ? $failed = true : $user->joinRoom($room->id);
        }

        if ($failed) {
            $request->session()->flash('alert-danger', 'We were unable to find that room. Please ensure the link is correct');

            return view('room-add');
        }
        return redirect()->route('room', ['key' => $room->key]);
    }

    public function leave(Room $room)
    {
        $user = User::find(1);
        $user->leaveRoom($room->id);

        return redirect()->route('home');
    }

    // Create new room (Join from URL)
    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), Room::$rules, Room::$messages);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation->messages());
        }

        // Generate new room key
        $key = substr(uniqid(), 6);
        while (Room::where('key', $key)->first() !== null) {
            $key = substr(uniqid(), 6);
        }

        $room = new Room([
            'name' => $request->get('name'),
            'key' => $key,
            'message' => $request->get('message'),
            'room_icon' => "",
            'creator_id' => User::find(1)->id,
            'is_private' => $request->has('is_private')
        ]);
        $room->save();

        User::find(1)->joinRoom($room->id);

        return redirect()->route('room', ['key' => $key]);
    }

}
