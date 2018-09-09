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

/**
 * Laravel Auth routes
 */
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


/**
 * Admin routes
 */
Route::group(['namespace' => 'Admin', 'middleware' => 'auth:admin'], function () {
	//Main admin page
	Route::get('admin/home', 'MainController@index')->name('admin');
	//User routes
	Route::resource('admin/user', 'UserController');
	//Article routes
	Route::resource('admin/post', 'ArticleController');
	//Tags routes
	Route::resource('admin/tag', 'TagController');
	//Categories routes
	Route::resource('admin/category', 'CategoriesController');
	//Role routes
	Route::resource('admin/roles', 'RoleController');
	//Permissions route
	Route::resource('admin/permissions', 'PermissionController');
	
	Route::resource('admin/commentaries', 'CommentController');
	
	
	
});
//Admin login
Route::get('admin-login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('admin-login', 'Admin\Auth\LoginController@login');
Route::get('admin/password/reset', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin/password/email', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin/password/reset/{token}', 'Admin\Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('admin/password/reset', 'Admin\Auth\ResetPasswordController@reset');
Route::post('admin-logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');



/**
 * User routes
 */
Route::group(['namespace' => 'User'], function () {
	Route::get('/', 'MainController@index')->name('home');
	Route::get('article/{article}', 'ArticleController@showArticle')->name('article');
	Route::get('articles/tag/{tag}', 'MainController@tag')->name('tag');
	Route::get('/category/{category}', 'MainController@categoryArticles')->name('category');
	Route::get('categories', 'MainController@listCategories')->name('categoryList');
	Route::get('tags', 'MainController@listTags')->name('tagList');
	Route::post('article/{article}/like', 'ArticleController@articleLike')->name('like');
	Route::post('comment/{comment}/like', 'ArticleController@commentLike')->name('commentlike');
	Route::post('article/{article}/visitor', 'ArticleController@visitorCounter')->name('visit');
	Route::get('comment/{comment}/like', 'ArticleController@commentLike')->name('commentlike');
	Route::get('activity', 'activityController@index')->name('activity');
	Route::get('user/{article}', 'ActivityController@userComments')->name('usercomments');
	
	Route::get('select2-autocomplete', 'Select2AutocompleteController@layout');
	Route::get('select2-autocomplete-ajax', 'Select2AutocompleteController@dataAjax');

	
	
});


Route::post('comments/{article}', 'Admin\CommentController@store')->name('comment');





