<?php

namespace App\Http\Controllers\Admin;

use App\Model\user\Article;
use App\Model\user\Category;
use App\Model\user\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$articles = Article::all();
		return view('admin.articles.list', compact('articles'));
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		if (Auth::user()->can('post.create')) {
			
			$tags = Tag::all();
			$categories = Category::all();
			return view('admin.articles.post', compact('tags', 'categories'));
		}
		return redirect(route('admin'));
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		
		$this->validate($request, [
			'title' => 'required',
			'subtitle' => 'required',
			'slug' => 'required',
			'body' => 'required',
			'img' => 'max:10240',
		]);
		
		if ($request->hasFile('img')) {
			$img = $request->img->store('public/images');
		} else {
			$img = 'public/images/default-post-img.jpg';
		}
		
		
		$article = new Article;
		$article->img = $img;
		$article->title = $request->title;
		$article->subtitle = $request->subtitle;
		$article->slug = $request->slug;
		$article->body = $request->body;
		$article->status = $request->status;
		$article->save();
		//Saving tags and categories using eloquent relationship many to many method, described in Article model
		$article->tags()->sync($request->tags);
		$article->categories()->sync($request->categories);
		
		
		return redirect(route('admin'));
		
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
		if (Auth::user()->can('post.update')) {
			$article = Article::with('tags', 'categories')->where('id', $id)->first();
			$tags = Tag::all();
			$categories = Category::all();
			return view('admin.articles.edit', compact('article', 'tags', 'categories'));
		}
		return redirect(route('admin'));
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
		$this->validate($request, [
			'title' => 'required',
			'subtitle' => 'required',
			'slug' => 'required',
			'body' => 'required',
		]);
		
		$article = Article::find($id);
		
		if ($request->hasFile('img')) {
			$img = $request->img->store('public/images');
			$article->img = $img;
		}
		
		$article->title = $request->title;
		$article->subtitle = $request->subtitle;
		$article->slug = $request->slug;
		$article->body = $request->body;
		$article->status = $request->status;
		$article->tags()->sync($request->tags);
		$article->categories()->sync($request->categories);
		$article->save();
		
		return redirect(route('post.index'));
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		Article::where('id', $id)->delete();
		return redirect()->back();
	}
}
