<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 */
class User extends Model
{
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $skills_level = [
        'Beginner' => 'Beginner',
        'Intermediate' => 'Intermediate',
        'Expert' => 'Expert'
    ];

    // ---------- FOLLOWING ----------
    // Get all followers of the user
    public function followers()
    {
        return $this->belongsToMany('App\User', 'followers', 'follow_id', 'user_id');
    }

    // Get users this user is following
    public function following()
    {
        return $this->belongsToMany('App\User', 'followers', 'user_id', 'follow_id');
    }

    // Follow $user
    public function follow()
    {
        $this->followers()->attach(2);
    }

    // Un-follow $user
    public function unfollow()
    {
        $this->followers()->detach(2);
    }

    // ---------- GROUPS ----------
    // Get all joined groups for user
    public function rooms()
    {
        return $this->belongsToMany('App\Room', 'joined_rooms', "user_id", "room_id");
    }

    // Join a group
    public function joinRoom($room_id)
    {
        if (!$this->inRoom($room_id)) {
            Room::find($room_id)->increment('joined_users');
            $this->rooms()->attach($room_id);
        }
    }

    // Leave a group
    public function leaveRoom($room_id)
    {
        if ($this->inRoom($room_id)) {
            Room::find($room_id)->deccrement('joined_users');
            $this->rooms()->detach($room_id);
        }
    }

    // Check if user is in the group
    public function inRoom($room_id)
    {
        return $this->rooms->contains($room_id);
    }

}
