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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
//get…URLを元に処理される
//post…送られたものを使って処理を行う
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register'); //get…URLを元に処理される
Route::post('/register', 'Auth\RegisterController@register'); //post通信だったらこっち

Route::get('/added', 'Auth\RegisterController@added');


//ログイン中のページ
Route::get('/top','PostsController@index');

Route::post('/post/create','PostsController@create');

Route::post('/update', 'PostsController@update');
//更新

Route::get('post/{id}/delete', 'PostsController@delete');
//idを元に削除の処理を行う

Route::get('/profile','UsersController@myprofile');

Route::post('/myprof','UsersController@myprofupdate');

Route::get('/{id}/profile','UsersController@profile');

Route::get('/search','UsersController@search');
Route::post('/search','UsersController@search');

Route::post('/follow','FollowsController@follow');

Route::post('/unfollow','FollowsController@unfollow');

Route::get('/followList','FollowsController@followList');
Route::get('/followerList','FollowsController@followerList');

Route::get('/logout','Auth\LoginController@logout');

