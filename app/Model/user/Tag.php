<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

/**
 * Tag model
 * @package App\Model\user
 */
class Tag extends Model
{
	/**
	 * Connecting tags with articles using eloquent many to many relations
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
    public function articles(){
    	return $this->belongsToMany('App\Model\User\Article','article_tags');
    }
	
	public function getRouteKeyName()
	{
		return 'slug';
	}
}
