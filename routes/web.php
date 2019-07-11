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

$slugPattern = '[a-z0-9\-]+';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return view('hello');

})->name('hello');

Route::get('/page/{param?}', function ($param = null) {
    return view('page', ['word'=>$param]);

});

// PUSGER

Route::get('/', 'ChatsController@index');
Route::get('messages', 'ChatsController@fetchMessages');
Route::post('messages', 'ChatsController@sendMessage');

Route::get('/mes', function () {
    return view('chat');
});


// Category
Route::get('/categories','CategoryController@index')->name('show_category');
Route::post('/categories','CategoryController@create')->name('categories');
Route::get('/categories/delete/{id}', 'CategoryController@delete');

Route::get('/categories/{slug}', 'CategoryController@show')->name('category.show')->where('slug', $slugPattern);

// POSTS
Route::get('/', 'HomeController@index')->name('home');
Route::post('/','HomeController@create')->name('add_post');
Route::get('/{slug}', 'PostController@show')->name('posts.show')->where('slug', $slugPattern);

// COMMENT

Route::post('comments', 'CommentController@create')->name('add_comment');

//Auth::routes();
//Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
//Route::post('login', 'Auth\LoginController@login');
//Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', '\App\Http\Controllers\Auth\RegisterController@create');


//Route::get('/wall/delete/{id_message}', 'WallController@delete')->middleware('auth');
Route::post('/wall/write', 'WallController@write');



//Route::get('/', 'PostController@index')->name('home');


Route::get('/user/{id}', 'PostController@user')->name('posts.user')->where('id', '[0-9]+');



Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::resource('posts', 'PostController');
});
Auth::routes();
