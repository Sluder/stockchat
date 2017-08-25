<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;

class RoomController extends Controller
{
    // Individual room view (Auto join user if not already)
    public function room($key)
    {
        $room = Room::where('key', $key)->first();

        if (!$room) {
            abort(404);

        } else if (!Auth::user()->inRoom($room->id)) {
            Auth::user()->joinRoom($room->id);
        }

        return view('pages.rooms.room', compact('room'));
    }

    // Join room from direct URL or inputting
    public function join($key = null, Request $request)
    {
        $failed = false;

        // User joining from form
        if (!$key) {
            if (starts_with($request->get("link"), env("APP_URL"))) {
                $room = Room::where("key", explode(env("APP_URL"), $request->get("link"))[1])->first();
                $room === null ? $failed = true : Auth::user()->joinRoom($room->id);
            } else {
                $failed = true;
            }
        // User joining from direct URL
        } else {
            $room = Room::where("key", $key)->first();
            $room === null ? $failed = true : Auth::user()->joinRoom($room->id);
        }

        if ($failed) {
            $request->session()->flash('alert-danger', 'We were unable to find that room. Please ensure the link is correct');

            return view('pages.rooms.room-add');
        }
        return redirect()->route('room', ['key' => $room->key]);
    }

    // Auth user leave a room
    public function leave($room_id)
    {
        Auth::user()->leaveRoom($room_id);

        return redirect()->route('home');
    }

    // Create new room (Room has 6-digit unique key)
    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), Room::$rules);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation->messages());
        }

        // Generate new room key
        $key =  rand(0, 9) . substr(uniqid(), 7);
        while (Room::where('key', $key)->first() !== null) {
            $key = substr(uniqid(), 7);
        }

        $room = Room::create([
            'name' => $request->get('name'),
            'key' => $key,
            'message' => $request->get('message'),
            'room_icon' => "",
            'creator_id' => Auth::id(),
            'is_private' => $request->has('is_private')
        ]);

        Auth::user()->joinRoom($room->id);

        return redirect()->route('room', ['key' => $key]);
    }

}
