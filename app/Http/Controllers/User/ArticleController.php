<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\CommentController;
use App\Model\admin\Comment;
use App\Model\user\Article;
use App\Model\user\Category;
use App\Model\user\CommentLike;
use App\Model\user\Like;
use App\Model\user\Tag;
use App\Model\user\Visitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/**
 * Controller of article page
 * Class ArticleController
 * @package App\Http\Controllers\User
 */
class ArticleController extends Controller
{
	
	
	/**
	 * Return requested article
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showArticle(Article $article)
	{
		//data for filters


		
		
		
		$article = $this->countLikes($article);
		$comments = $this->getComments($article);
		
		$isAnalytic = false;
		if ($article->categories()->where('category_id', 6)->first()) {
			if (!Auth::user()) {
				$article->body = $this->getFirstFiveSentences($article->body, 3);
				$isAnalytic = true;
			}
		};
		
		return view('user.article', compact('article', 'isAnalytic', 'comments','filterCategories','filterTags'));
	}
	
	
	/**
	 * method for adding visitors counter to article
	 * @param Article $article
	 * @param int $num
	 */
	public function visitorCounter(Article $article, Request $request)
	{
		
		$visitors = Visitor::firstOrNew(['article_id' => $article->id]);
		
		$visitors->visited = ($visitors->visited + $request->visit);
		$visitors->save();
		
		return $visitors->visited;
		
	}
	
	/**
	 * Calculating likes and check if logged user did like, then return modified article object
	 * @param Article $article
	 * @return Article
	 */
	public function countLikes(Article $article)
	{
		//like dislike count
		$article = Article::find($article->id);
		$article->like = $article->likes()->where('article_id', $article->id)->where('like', 1)->count();
		$article->dislike = $article->likes()->where('article_id', $article->id)->where('like', 0)->count();
		$article->save();
		
		//checking if user is logged in, then check if user did like or dislike on this post and modify the Article object
		if (Auth::user()) {
			$likedByUser = Auth::user()->likes()->where('article_id', $article->id)->where('like', 1)->first();
			if ($likedByUser) {
				$article->setAttribute('likedByUser', true);
			}
			$dislikedByUser = Auth::user()->likes()->where('article_id', $article->id)->where('like', 0)->first();
			if ($dislikedByUser) {
				$article->setAttribute('dislikedByUser', true);
			}
		}
		
		return $article;
	}
	
	/**
	 * Getting comments for this article
	 * @param Article $article
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getComments(Article $article)
	{
		$comments = $article->comments()->where('article_id', $article->id)->where('approved', 1)->orderBy('like', 'DESC')->get();
		
		foreach ($comments as $comment) {
			$updatedItem = CommentController::countLikes($comment);
			if ($updatedItem->likedByUser) {
				$comment->likedByUser = $updatedItem->likedByUser;
			}
			if ($updatedItem->dislikedByUser) {
				$comment->dislikedByUser = $updatedItem->dislikedByUser;
			}
			
			$comment->name = $comment->user()->first()->name;
		}
		return $comments;
	}
	
	/**
	 * Trim first 5 sentences for unauthorized user of Analytic category
	 * @param $body
	 * @param int $sentencesToDisplay
	 * @return null|string|string[]
	 */
	public function getFirstFiveSentences($body, $sentencesToDisplay = 5)
	{
		$nakedBody = preg_replace('/\s+/', ' ', strip_tags($body));
		$sentences = preg_split('/(\.|\?|\!)(\s)/', $nakedBody);
		
		if (count($sentences) <= $sentencesToDisplay)
			return $nakedBody;
		
		$stopAt = 0;
		foreach ($sentences as $i => $sentence) {
			$stopAt += strlen($sentence);
			
			if ($i >= $sentencesToDisplay - 1)
				break;
		}
		
		$stopAt += ($sentencesToDisplay * 2);
		return '<p style="margin-bottom: 0px">' . trim(substr($nakedBody, 0, $stopAt)) . '..' . '</p>';
	}
	
	/**
	 * Method for article like/dislike system
	 * @param Article $article
	 * @param Request $request
	 * @return null|string
	 */
	public function articleLike(Article $article, Request $request)
	{
		
		$isLike = $request->isLike;
		//if isLike value from POST == 1 make it bool TRUE else bool FALSE (this values go to database 'like' row
		if ($isLike == 1) {
			$isLike = true;
		} else {
			$isLike = false;
		}
		
		$update = false;
		
		//finding Article by its id, if not found exit method
		$article = Article::find($article->id);
		if (!$article) {
			return null;
		}
		//finding User by its id who want to like, if not found exit method
		$user = Auth::user();
		if (!$user) {
			//if not logged user try to like return false (redirecting on js side)
			return 0;
		}
		
		//getting all likes done for this article by this user
		$like = $user->likes()->where('article_id', $article->id)->first();
		
		//if user liked article before:
		if ($like) {
			//updating like state
			$liked = $like->like;
			$update = true;
			if ($liked == $isLike) {
				$like->delete();
				
				$article = $this->countLikes($article);
				global $comments;
				global $isAnalytic;
				return view('user.article', compact('article', 'isAnalytic', 'comments'));
			}
		} else {
			$like = new Like;
		}
		$like->like = $isLike;
		$like->user_id = $user->id;
		$like->article_id = $article->id;
		if ($update) {
			$like->update();
		} else {
			$like->save();
		}
		
		//recalculating likes and returning view for appending (should change to json later, no time for now)
		$article = $this->countLikes($article);
		global $comments;
		global $isAnalytic;
		return view('user.article', compact('article', 'isAnalytic', 'comments'));
	}
	
	/**
	 * Method for comment like later need
	 * TODO: later need to be moved to comment controller and make separate comment view for ajax response
	 * @param Comment $comment
	 * @param Request $request
	 * @return int|null|string
	 */
	public function commentLike(Comment $comment, Request $request)
	{
		$isLike = $request->isCommentLike;
		//if isLike value from POST == 1 make it bool TRUE else bool FALSE (this values go to database 'like' row
		if ($isLike == 1) {
			$isLike = true;
		} else {
			$isLike = false;
		}
		
		$update = false;
		
		//finding Article by its id, if not found exit method
		
		$comment = Comment::find($comment->id);
		if (!$comment) {
			return null;
		}
		//finding User by its id who want to like, if not found exit method
		$user = Auth::user();
		if (!$user) {
			//if not logged user try to like return false (redirecting on js side)
			return 0;
		}
		
		//getting all likes done for this article by this user
		$like = $user->commentLike()->where('comment_id', $comment->id)->first();
		//if user liked article before:
		if ($like) {
			//updating like state
			$liked = $like->like;
			$update = true;
			if ($liked == $isLike) {
				$like->delete();
				
				$comment = CommentController::countLikes($comment);
				return view('user.comment', compact('comment'));
			}
		} else {
			$like = new CommentLike;
		}
		$like->like = $isLike;
		$like->user_id = $user->id;
		$like->comment_id = $comment->id;
		if ($update) {
			$like->update();
		} else {
			$like->save();
		}
		
		//recalculating likes and returning view for appending (should change to json later, no time for now)
		$comment = CommentController::countLikes($comment);
		return view('user.comment', compact('comment'));
	}
	
	public function filter() {
		
		
		$filter=$filter->flatten(0);
		return $filter;
		
		
		
	}
	
	
}
