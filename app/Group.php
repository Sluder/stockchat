<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 */
class Group extends Model
{
    protected $guarded = [];
    public $timestamps = true;

    // Get suggested groups for the user
    public static function getSuggested()
    {
        return self::all()->take(4);
    }

}
