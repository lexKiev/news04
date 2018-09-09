<?php

namespace App\Http\Controllers\Admin;

use App\Model\admin\Comment;
use App\Model\user\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class CommentController extends Controller
{

//	public function __construct()
//	{
//		$this->middleware('can:post.commentaries');
//	}
	
	/**
	 * Method for checking if currently logged user did like on requested comment, this needed to change view
	 * @param Comment $comment
	 * @return Comment
	 */
	public static function countLikes(Comment $comment)
	{
		//like dislike count
		
		$comment = Comment::find($comment->id);
		
		$comment->like = $comment->likes()->where('comment_id', $comment->id)->where('like', 1)->count();
		$comment->dislike = $comment->likes()->where('comment_id', $comment->id)->where('like', 0)->count();
		$comment->save();
		
		//checking if user is logged in, then check if user did like or dislike on this post and modify the Article object
		if (Auth::user()) {
			$likedByUser = Auth::user()->commentLike()->where('comment_id', $comment->id)->where('like', 1)->first();
			
			if ($likedByUser) {
				$comment->setAttribute('likedByUser', true);
				
			}
			$dislikedByUser = Auth::user()->commentLike()->where('comment_id', $comment->id)->where('like', 0)->first();
			
			if ($dislikedByUser) {
				$comment->setAttribute('dislikedByUser', true);
			}
		}
		
		return $comment;
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		if (Auth::user()->can('post.commentaries')) {
			$commentaries = Comment::with('user')->with('article')->orderBy('created_at', 'DESC')->orderBy('approved', 'DESC')->get();
			return view('admin.commentaries.list', compact('commentaries'));
		}
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, $id)
	{
		
		$this->validate($request, [
			'comment' => 'required|max:255',
		]);
		
		
		$comment = new Comment;
		$comment->article_id = $id;
		$comment->user_id = Auth::user()->id;
		$comment->comment = $request->comment;
		$comment->approved = 1;
		//checking if article has POLITICS category, if so comment will be NOT APPROVED and waiting premoderation
		$article = Article::where('id',$id)->with('categories')->first();
		foreach ($article->categories as $category){
			if ($category->id == 2){
				$comment->approved = 0;
				$request->session()->flash('message', 'Your commentaries will be displayed after approval');
			}
		}
		$comment->save();
		
		return Redirect::to(URL::previous() . "#comment-block");
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if (Auth::user()->can('post.commentaries')) {
			$commentary = Comment::where('id', $id)->first();
			
			return view('admin.commentaries.edit', compact('commentary'));
		}
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if (Auth::user()->can('post.commentaries')) {
			$this->validate($request, [
				'comment' => 'required|max:255',
			]);
			
			$commentary = Comment::find($id);
			
			$commentary->comment = $request->comment;
			$commentary->approved = $request->approved;
			$commentary->save();
			return redirect(route('commentaries.index'));
		}
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if (Auth::user()->can('post.commentaries')) {
			Comment::where('id', $id)->delete();
			return redirect()->back();
		}
	}
}
