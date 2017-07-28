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

    // This user wants to follower $user
    public function follow(User $user)
    {
        $this->followers()->attach($user->id);
    }

    // This user wants to un-follow $user
    public function unfollow(User $user)
    {
        $this->followers()->detach($user->id);
    }

    // ---------- GROUPS ----------

}
