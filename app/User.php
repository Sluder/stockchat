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
    public function groups()
    {
        return $this->belongsToMany('App\Group', 'group_joins', "user_id", "group_id");
    }

    // Join a group
    public function joinGroup($group_id)
    {
        $this->groups()->attach($group_id);
    }

    // Leave a group
    public function leaveGroup($group_id)
    {
        $this->groups()->detach($group_id);
    }

}
