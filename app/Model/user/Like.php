<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function user(){
    	return $this->belongsTo('App\Model\user\User');
    }
	
	public function post(){
		return $this->belongsTo('App\Model\user\Article');
	}
}
