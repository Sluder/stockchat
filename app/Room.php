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

    public static $rules = [
        'name' => 'required|min:1|max:45',
        'objective' => 'nullable|max:100'
    ];

    public static $messages = [
        'name.required' => "Please create a name for your group",
        'name.max' => 'Your group name is too large',
        'objective.max' => 'Your group objective is too large'
    ];

    // Get suggested groups for the user
    public static function getSuggested()
    {
        return self::all()->take(4);
    }

}
