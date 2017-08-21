<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Support\Facades\Auth;

class User extends Model implements Authenticatable
{
    use AuthenticatableTrait;

    protected $table = 'users';
    public $timestamps = true;
    protected $fillable = ['name', 'email', 'profile_img', 'username', 'username_last_changed', 'settings_id', 'password'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $skills_level = [
        'Beginner' => 'Beginner',
        'Intermediate' => 'Intermediate',
        'Expert' => 'Expert'
    ];

    // Request validation rules
    public static $join_rules = [
        'name' => 'required|min:1|max:50',
        'username' => 'required|min:1|max:20',
        'email' => 'required|email|min:1|max:100',
        'password' => 'required|min:5|max:100',
    ];
    public static $login_rules = [
        'login' => 'required|min:1|max:100',
        'password' => 'required|min:5|max:100',
    ];

    // Retrieves settings for the user
    public function settings()
    {
        return $this->belongsTo('App\Settings');
    }

    // ---------- Follows ----------
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

    // Check is user is following another
    public function isFollowing($id)
    {
        return $this->following->contains($id);
    }

    // Follow $user
    public function follow($id)
    {
        $this->following()->attach($id);
    }

    // Un-follow $user
    public function unfollow($id)
    {
        $this->following()->detach($id);
    }

    // ---------- Rooms ----------
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
            Room::find($room_id)->decrement('joined_users');
            $this->rooms()->detach($room_id);
        }
    }

    // Check if user has joined a room
    public function inRoom($room_id)
    {
        return $this->rooms->contains($room_id);
    }

}
