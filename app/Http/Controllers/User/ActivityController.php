<?php

namespace App\Http\Controllers\user;

use App\Model\admin\Comment;
use App\Model\user\Article;
use App\Model\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
	
	public function index()
	{
		
		$users = User::Has('comments')->withCount('comments')->orderBy('comments_count', 'DESC')->get();
		
		$articles = Article::Has('comments')->withCount('comments')->orderBy('comments_count', 'DESC')->get();
		
		return view('user.activity', compact('users', 'articles'));
		
	}
	
	public function userComments($id)
	{
		$comments = Comment::where('user_id',$id)->with('user')->orderBy('created_at','DESC')->paginate(5);
//		dd($comments);
		return view('user.commentslist', compact('comments'));
	}
	
	
}
