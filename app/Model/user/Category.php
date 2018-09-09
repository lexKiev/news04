<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

/**
 * Category model
 * @package App\Model\user
 */

class Category extends Model
{
	/**
	 * Connecting cetegoies to articles using eloquent many-to-many relationship
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function articles(){
		return $this->belongsToMany('App\Model\User\Article','category_articles');
	}
	
	public function getRouteKeyName()
	{
		return 'slug';
	}
	
}
