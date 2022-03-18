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
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');


//ログイン中のページ
Route::get('/top','PostsController@index');

Route::post('/post/create','PostsController@create');

Route::post('/update', 'PostsController@update'); //更新

Route::get('post/{id}/delete', 'PostsController@delete');
Auth::routes();

Route::get('/profile','UsersController@myprofile');

Route::get('/{id}/profile','UsersController@profile');

Route::get('/search','UsersController@search');
Route::post('/search','UsersController@search');

Route::post('/follow','FollowsController@follow');

Route::post('/unfollow','FollowsController@unfollow');

Route::get('/followList','FollowsController@followList');
Route::get('/followerList','FollowsController@followerList');


//Route::get('/', function () {
//  return view('auth.login');
//    });