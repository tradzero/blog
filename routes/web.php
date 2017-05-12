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

Route::get('/', 'Www\PostController@index');
Route::get('/post/{id}', 'Www\PostController@show')->name('post.show');
Auth::routes();
Route::get('/home', 'HomeController@index');
Route::group(['middleware' => ['auth']], function () {
    Route::post('/comment/{id}', 'Www\CommentController@store');
});
Route::get('/tag/{id}', 'Www\TagController@show');
Route::patch('/post/{id}/like', 'Www\PostController@like');
Route::patch('/comment/{id}/like', 'Www\CommentController@like');

Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'namespace' => 'Admin'], function () {
    Route::get('/', 'HomeController@index');
    Route::patch('posts/{id}/recovery', 'PostController@recovery')->name('posts.recovery');
    Route::resource('posts', 'PostController');
    Route::resource('tags', 'TagController');
    
    Route::post('comments/{id}/deny', 'CommentController@deny')->name('comments.deny');
    Route::post('comments/{id}/pass', 'CommentController@pass')->name('comments.pass');
    Route::resource('comments', 'CommentController');

    Route::resource('users', 'UserController');
    Route::post('/upload', 'UploadController@qiniuUpload');
});

Route::group(['prefix' => 'api', 'middleware' => ['auth', 'admin'], 'namespace' => 'Api'], function () {
    Route::resource('tag', 'TagController');
});
