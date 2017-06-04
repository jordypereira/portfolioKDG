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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

//POSTS
Route::get('posts', 'PostsController@index');
Route::get('posts/{post}', 'PostsController@show');

//POST EDIT
Route::post('posts/{post}/edit', 'PostsController@editPost');
Route::patch('posts/{post}', 'PostsController@update');

//POST DELETE
Route::delete('posts/{post}', 'PostsController@delete');

//POST VOTE
Route::post('posts/{post}/upvote', 'PostsController@upvote');
Route::post('posts/{post}/downvote', 'PostsController@downvote');

//COMMENT ON POST
Route::post('posts/{post}/comment', 'PostsController@addComment');
Route::post('posts', 'PostsController@addPost');

//COMMENT DELETE
Route::delete('comments/{comment}', 'CommentsController@delete');
