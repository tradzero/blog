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
Route::get('/post/{id}', 'Www\PostController@show');
Auth::routes();
Route::get('/home', 'HomeController@index');
Route::group(['middleware' => ['auth']], function() {
    // parameter id 文章id
    Route::post('/comment/{id}', 'Www\CommentController@store');
});
Route::get('/tag/{id}', 'Www\TagController@show');
Route::patch('/post/{id}/like', 'Www\PostController@like');
Route::patch('/comment/{id}/like', 'Www\CommentController@like');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function() {
    Route::get('/', 'Admin\HomeController@index');
    Route::patch('posts/{id}/recovery', 'Admin\PostController@recovery')->name('posts.recovery');
    Route::resource('posts', 'Admin\PostController');

    Route::resource('tags', 'Admin\TagController');
    Route::post('/upload', 'Admin\UploadController@qiniuUpload');
});

Route::group(['prefix' => 'api', 'middleware' => ['auth', 'admin'], 'namespace' => 'Api'], function() {
    Route::resource('tag', 'TagController');
});