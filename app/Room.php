<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @property mixed id
 */
class Room extends Model
{
    public $timestamps = true;
    protected $table = 'rooms';
    protected $guarded = [];

    // Request validation rules
    public static $rules = [
        'name' => 'required|min:1|max:45',
        'message' => 'nullable|max:100'
    ];

    // Get suggested groups for the user
    public static function getSuggested()
    {
        $rooms = self::where('is_private', 0)->get();

        $rooms = $rooms->filter(function ($room) {
            return !Auth::user()->inRoom($room->id);
        });

        return $rooms->count() >= 4 ? $rooms->random(4) : $rooms;
    }

}
