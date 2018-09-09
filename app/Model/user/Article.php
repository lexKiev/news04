<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

/**
 * Article model
 * @package App\Model\user
 */
class Article extends Model
{
	
	/**
	 * Connecting articles with tags using eloquent many to many relations
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function tags()
	{
		return $this->belongsToMany('App\Model\User\Tag', 'article_tags')->withTimestamps();
	}
	
	/**
	 * Connecting categories with articles using eloquent many to many relations
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function categories()
	{
		return $this->belongsToMany('App\Model\User\Category', 'category_articles')->withTimestamps();
	}
	
	/**
	 * Connecting likes with articles using eloquent has many relations
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function likes()
	{
		return $this->hasMany('App\Model\user\Like');
	}
	
	/**
	 * Connecting comments with articles using eloquent has many relations
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function comments()
	{
		return $this->hasMany('App\Model\admin\Comment');
	}
	
	public function getRouteKeyName()
	{
		return 'slug';
	}
}
