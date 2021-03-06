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

Route::get('/', [
	'uses' => 'BlogController@index',
	'as' => 'blog'
]);

Route::get('/blog/{post}', [
	'uses' => 'BlogController@show',
	'as' => 'blog.show'
]);

Route::post('/blog/comments', [
	'uses' => 'CommentsController@store',
	'as' => 'blog.comments'
]);

Route::get('/category/{category}', [
	'uses' => 'BlogController@category',
	'as' => 'category'
]);

Route::get('/author/{author}', [
	'uses' => 'BlogController@author',
	'as' => 'author'
]);

Route::get('/tag/{tag}', [
	'uses' => 'BlogController@tag',
	'as' => 'tag'
]);

Auth::routes();

Route::get('/home', 'Backend\HomeController@index')->name('home');
Route::get('/edit-account', 'Backend\HomeController@edit');
Route::put('/edit-account', 'Backend\HomeController@update');

Route::put('/backend/blog/restore/{blog}', [
	'uses' => 'Backend\BlogController@restore',
	'as' => 'backend.blog.restore'
]);
Route::delete('/backend/blog/force-destroy/{blog}', [
	'uses' => 'Backend\BlogController@forceDestroy',
	'as' => 'backend.blog.force-destroy'
]);
Route::name('backend.')->group(function (){
	Route::resource('/backend/blog', 'Backend\BlogController');
});
Route::name('backend.')->group(function (){
	Route::resource('/backend/categories', 'Backend\CategoriesController');
});

Route::name('backend.')->group(function (){
	Route::resource('/backend/users', 'Backend\UsersController');
});
Route::get('/backend/users/confirm/{users}', [
	'uses' => 'Backend\UsersController@confirm',
	'as' => 'backend.users.confirm'
]);

Route::get('/data-category', [
	'uses'	=> 'Backend\CategoriesController@dataCategory',
	'as'	=> 'data.category'
]);

Route::get('/data-user', [
	'uses'	=> 'Backend\UsersController@dataUser',
	'as'	=> 'data.user'
]);

Route::get('/data-post', [
	'uses'	=> 'Backend\BlogController@dataPost',
	'as'	=> 'data.post'
]);
