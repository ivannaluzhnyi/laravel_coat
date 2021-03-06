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


// Category
Route::get('/categories','CategoryController@index')->middleware('auth')->name('show_category');
Route::post('/categories','CategoryController@create')->middleware('auth')->name('categories');
Route::get('/categories/delete/{id}', 'CategoryController@delete')->middleware('auth');

Route::get('/categories/{slug}', 'CategoryController@show')->name('category.show')->where('slug', $slugPattern);

// POSTS

Route::post('/','HomeController@create')->middleware('auth')->name('posts');
Route::get('/{slug}', 'PostController@show')->name('posts.show')->where('slug', $slugPattern);

// COMMENT

Route::post('', 'CommentController@create')->name('add_comment');

//Auth::routes();
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset');


// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', '\App\Http\Controllers\Auth\RegisterController@create');

Route::get('/', 'HomeController@index')->middleware('auth')->name('home');
Route::get('/wall/delete/{id_message}', 'WallController@delete')->middleware('auth');
Route::post('/wall/write', 'WallController@write');

Route::get('/profil/{param?}', 'ProfilController@index')->name('profil');
Route::get('/settings', 'SettingsController@index');

Route::post('/settings', 'SettingsController@image')->name('SettingsImage');
Route::get('/', 'PostController@index')->name('home');
Route::get('/{slug}', 'PostController@show')->name('posts.show')->where('slug', $slugPattern);
Route::get('/category/{slug}', 'PostController@category')->name('posts.category')->where('slug', $slugPattern);

Route::get('/user/{id}', 'PostController@user')->name('posts.user')->where('id', '[0-9]+');



Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::resource('posts', 'PostController');
});
