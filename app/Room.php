<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 */
class Room extends Model
{
    protected $guarded = [];
    public $timestamps = true;

    // Request validation rules
    public static $rules = [
        'name' => 'required|min:1|max:45',
        'message' => 'nullable|max:100'
    ];
    // Request failed validation messages
    public static $messages = [
        'name.required' => "Please create a name for your group",
        'name.max' => 'Your group name is too large',
        'message.max' => 'Your group objective is too large'
    ];

    // Get suggested groups for the user
    public static function getSuggested()
    {
        $rooms = self::where('is_private', 0)->get();

        $rooms = $rooms->filter(function ($room) {
            $user = User::find(1);
            return !$user->inRoom($room->id);
        });

        return $rooms->count() >= 4 ? $rooms->random(4) : $rooms;
    }

}
