<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|
*/

Route::get('/', function () {
	return view('user.news04');
});

Route::get('article', function () {
	return view('user.article');
})->name('article');

Route::get('admin/home', function () {
	return view('admin.home');
})->name('admin');

Route::get('admin/post', function () {
	return view('admin.articles.post');
});

Route::get('admin/tag', function () {
	return view('admin.tags.tag');
});

Route::get('admin/category', function () {
	return view('admin.categories.category');
});