<?php

namespace App\Http\Controllers\User;

use App\Model\user\Article;
use App\Model\user\Category;
use App\Model\user\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilterController extends Controller
{
    public function index(Request $request) {
    
    	$categories = Category::get();
    	$tags = Tag::get();
    	
    	$article = Article::with('categories','tags')->get();
	    dd($article);
    	$article->tags()->where('tag_id','=','5');

    	return $request;
    	
    	
    	
    }
}
