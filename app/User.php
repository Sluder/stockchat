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

    // Get all followers of the user
    public function followers()
    {
        return $this->belongsToMany('App\User', 'followers', 'user_id', 'follower_id');
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

    // Get all groups this user is in currently
    public function joinedGroups()
    {
        return $this->belongsToMany('App\Group', 'groups', 'group_id', 'user_id');
    }

    // This user wants to join group $group->id
    public function joinGroup(Group $group)
    {
        $this->joinedGroups()->attach($group->id);
    }

    // This user wants to leave group $group->id
    public function leaveGroup(Group $group)
    {
        $this->followers()->detach($group->id);
    }

}
