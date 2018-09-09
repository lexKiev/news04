<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    //
	protected $fillable = [
		'article_id', 'visited',
	];
}
