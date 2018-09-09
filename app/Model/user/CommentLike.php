<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class CommentLike extends Model
{
	public function user(){
		return $this->belongsTo('App\Model\user\User');
	}
	
	public function comment(){
		return $this->belongsTo('App\Model\admin\Comment');
	}
	
	
}
