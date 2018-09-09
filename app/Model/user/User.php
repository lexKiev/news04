<?php

namespace App\Model\User;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	/**
	 * Connecting likes with user using eloquent has many relations
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function likes(){
		return $this->hasMany('App\Model\user\Like');
	}
	
	/**
	 * Connecting comments with user using eloquent has many relations
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function comments()
	{
		return $this->hasMany('App\Model\admin\Comment');
	}
	
	public function commentLike()
	{
		return $this->hasMany('App\Model\user\CommentLike');
	}
}
