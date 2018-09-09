<?php

namespace App\Http\Controllers\User;

use App\Model\user\Article;
use App\Model\user\Category;
use App\Model\user\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 *
 * Class MainController
 * @package App\Http\Controllers\User
 * Main page controller
 */
class MainController extends Controller
{
	
	/**Index method rendering main site page with categories tree and last 5 news in that category
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		$categories = Category::all();
		foreach ($categories as $category) {
			$collection[$category->slug] = $category->articles()->where('status', 1)->orderBy('created_at', 'desc')->limit(5)->get();
		}
		
		$articles = Article::where('status', 1)->orderBy('created_at', 'desc')->limit(15)->get();
		
		return view('user.news04', compact('categories', 'collection', 'articles'));
	}
	
	/**
	 * Getting list of articles by selected tag
	 * @param Tag $tag
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function tag(Tag $tag)
	{
		$title = "Articles with $tag->name Tag";
		$articles = $tag->articles()->where('status', 1)->orderBy('created_at', 'desc')->paginate(5);
		return view('user.categoryarticles', compact('articles','title'));
	}
	
	/**
	 * Getting list of articles by selected category
	 * @param Category $category
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function categoryArticles(Category $category)
	{
		$title = "Articles in $category->name Category";
		$articles = $category->articles()->where('status', 1)->orderBy('created_at', 'desc')->paginate(5);
		return view('user.categoryarticles', compact('articles','title'));
	}
	
	public function listCategories()
	{
		
		$categories = Category::all();
		foreach ($categories as $category) {
			$category->countArticles = $category->articles()->where('status', 1)->count();
		}

		return view('user.categories', compact('categories'));
	}
	
	public function listTags()
	{
		$tags = Tag::paginate(5);
		foreach ($tags as $tag) {
			$tag->countArticles = $tag->articles()->where('status', 1)->count();
		}
		return view('user.tags', compact('tags'));
	}

	
}
