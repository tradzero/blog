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
Route::patch('/post/{id}/like', 'Www\PostController@like');
Route::patch('/comment/{id}/like', 'Www\CommentController@like');;