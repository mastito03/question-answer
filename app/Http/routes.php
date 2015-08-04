<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	]);

// Route::group(['domain' => env('APP_HOST', 'localhost')],function ()
// {

Route::resource('sites','SiteController');

// });

// Route::group(['domain' => '{domain}.'.env('APP_HOST', 'localhost'),'middleware' => 'site'],function ()
// {
Route::get('/','QuestionController@index');
Route::get('unanswered',[
	'as'=>'questions.unanswered',
	'uses'=>'QuestionController@unanswered'
	]);


Route::resource('questions','QuestionController');
Route::post('questions/{questions}/upvote',[
	'as'=>'questions.upvote',
	'uses'=>'QuestionController@upvote'
	]);
Route::post('questions/{questions}/downvote',[
	'as'=>'questions.downvote',
	'uses'=>'QuestionController@downvote'
	]);

Route::post('questions/{questions}/favorites',[
	'as'=>'questions.favorites',
	'uses'=>'QuestionController@favorites'
	]);


Route::resource('questions.answers','AnswerController');
Route::post('questions/{questions}/answers/{answers}/upvote',[
	'as'=>'questions.answers.upvote',
	'uses'=>'AnswerController@upvote'
	]);
Route::post('questions/{questions}/answers/{answers}/downvote',[
	'as'=>'questions.answers.downvote',
	'uses'=>'AnswerController@downvote'
	]);

Route::resource('questions.comments','QuestionCommentController');
Route::resource('questions.answers.comments','AnswerCommentController');


Route::resource('tags','TagController');
Route::resource('users','UserController');


////////// API /////////////

Route::get('api/tags/{query}','TagController@apiGetTags');

///////// setup ///////////

Route::get('setup_this',function ()
{
	Artisan::queue('migrate');
	return redirect('/');
});

// });