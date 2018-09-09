<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	/**
	 * Connecting comments to article using belongs to eloquent relation
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function article(){
    	return $this->belongsTo('App\Model\user\Article');
    }
	
	/**
	 * Connecting comments to user using belongs to eloquent relation
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user(){
		return $this->belongsTo('App\Model\user\User');
	}
	
	public function likes()
	{
		return $this->hasMany('App\Model\user\CommentLike');
	}
 
 
}
