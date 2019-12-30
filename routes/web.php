<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function(){
	return redirect('/homepage');
});

Route::get('/homepage', 'Client\PageController@getHomepage');

Route::post('/homepage/loadmore', 'Client\PageController@loadmore');

Route::get('/about', 'Client\PageController@getAboutsPage');

Route::get('/contact', 'Client\PageController@getContactPage');

Route::get('/post/{titleUrl}', 'Client\PageController@getPost');

Route::post('/post/{titleUrl}/comment', 'Client\CommentController@comment');

Route::post('/post/{titleUrl}/comment/{commentID}', 'Client\CommentController@replycomment');

Route::get('/tag/{name}', 'Client\SearchController@getTagAchive');

Route::get('/category/{name}', 'Client\SearchController@getCategoryPosts');

Route::post('/subscribe', 'Client\SubscribeController@subscribe');

Route::get('/search', function(){
	return redirect()->back();
});

Route::post('/search', 'Client\SearchController@search');

Route::group(['prefix'=>'admin'], function(){
	Route::get('/', function(){
		return redirect('admin/login');
	});

	Route::get('/login', 'Admin\AuthenticationController@getLoginPage');
	Route::post('/login', 'Admin\AuthenticationController@login');

	Route::group(['middleware'=>['adminAuthentication']], function(){

		Route::get('/dashboard', 'Admin\DashboardController@getDashboard');

		//posts route
		Route::get('/posts', 'Admin\PostController@getPostManage');
		Route::post('posts/store', 'Admin\PostController@storePost');
		Route::get('posts/{id}/edit', 'Admin\PostController@getEditPost');
		Route::post('posts/{id}/store', 'Admin\PostController@storeEdit');
		Route::get('posts/{id}/delete', 'Admin\PostController@delete');
		Route::get('/createpost', 'Admin\PostController@getWritePage');

		//tags route
		Route::get('/tags', 'Admin\TagsController@index');
		Route::post('/tags/store', 'Admin\TagsController@store');
		Route::get('tags/{id}/edit', 'Admin\TagsController@edit');
		Route::get('tags/{id}/delete', 'Admin\TagsController@delete');

		//categories route
		Route::get('/categories', 'Admin\CategoryController@index');
		Route::post('/categories/store', 'Admin\CategoryController@store');
		Route::get('/categories/{id}/edit', 'Admin\CategoryController@edit');
		Route::get('/categories/{id}/delete', 'Admin\CategoryController@delete');

		//account manage  route
		Route::get('/account', 'Admin\AuthenticationController@getAccountPage');
		Route::get('/logout', 'Admin\AuthenticationController@logout');
		Route::post('/account', 'Admin\AuthenticationController@changeAccountInfo');
		Route::post('/account/changepassword', 'Admin\AuthenticationController@changePassword');

		//subscriber
		Route::get('/subscriber', 'Admin\SubscriberController@index');

		//comment
		Route::get('/comment', 'Admin\CommentController@index');
		Route::get('/comment/unmoderated', 'Admin\CommentController@unmoderatedComment');
		Route::get('/comment/moderated', 'Admin\CommentController@moderatedComment');

		Route::get('/comment/{id}/edit', 'Admin\CommentController@edit');
		Route::get('/comment/{id}/delete', 'Admin\CommentController@delete');
	});
});


