<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', 'PagesController@spa')->name('pages.home');
// Route::get('nosotros', 'PagesController@about')->name('pages.about');
// Route::get('archivo', 'PagesController@archive')->name('pages.archive');
// Route::get('contacto', 'PagesController@contact')->name('pages.contact');


// Route::get('blog/{post}', 'PostsController@show')->name('posts.show');
// Route::get('categories/{category}', 'CategoriesController@show')->name('categories.show');
// Route::get('tags/{tag}', 'TagsController@show')->name('tags.show');

//Admin
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'],function(){
    
    Route::get('/', 'AdminController@index')->name('dashboard');

    Route::resource('posts', 'PostsController', ['except' => 'show', 'as' => 'admin']);
    Route::resource('users', 'UsersController', ['as' => 'admin']);
    Route::resource('roles', 'RolesController', ['except' => 'show', 'as' => 'admin']);
    Route::resource('permissions', 'PermissionsController', ['only' => ['index', 'edit', 'update'], 'as' => 'admin']);

    Route::middleware('role:Admin')->put('users/{user}/roles', 'UsersRolesController@update')->name('admin.users.roles.update');
    Route::middleware('role:Admin')->put('users/{user}/permissions', 'UsersPermissionsController@update')->name('admin.users.permissions.update');

    Route::post('posts/{post}/photos', 'PhotosController@store')->name('admin.posts.photos.store');
    Route::delete('photos/{photo}', 'PhotosController@destroy')->name('admin.photos.destroy');
});

//Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//Password reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::get('/{any?}', 'PagesController@spa')->name('pages.home')->where('any','.*');
//Route::get('/{any?}', 'PagesController@spa')->name('pages.home');