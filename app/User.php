<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class User extends Model implements Authenticatable
{
    use AuthenticatableTrait;

    protected $table = 'users';
    public $timestamps = true;
    protected $fillable = ['name', 'email', 'username', 'username_last_changed', 'settings_id', 'password'];

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
        'username' => 'required|min:1|max:15',
        'email' => 'required|email|min:1|max:100',
        'password' => 'required|min:5|max:100',
    ];
    public static $login_rules = [
        'login' => 'required|min:1|max:100',
        'password' => 'required|min:5|max:100',
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
