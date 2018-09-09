<?php

namespace App\Model\Admin;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
	use Notifiable;
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password','status','phone'
	];
	
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];
	
	
	public function roles(){
	
		return $this->belongsToMany('App\Model\Admin\Role');
		
	}
	
	public function getRememberToken()
	{
		return null; // not supported
	}
	
	public function setRememberToken($value)
	{
		// not supported
	}
	
	public function getRememberTokenName()
	{
		return null; // not supported
	}
	
	/**
	 * Overrides the method to ignore the remember token.
	 */
	public function setAttribute($key, $value)
	{
		$isRememberTokenAttribute = $key == $this->getRememberTokenName();
		if (!$isRememberTokenAttribute) {
			parent::setAttribute($key, $value);
		}
		
	}
}
