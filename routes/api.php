<?php

use Illuminate\Support\Facades\Route;

Route::get('posts','PagesController@home');
Route::get('blog/{post}','PostsController@show');
Route::get('categorias/{category}','CategoriesController@show');
Route::get('tags/{tag}', 'TagsController@show');
Route::get('archivo', 'PagesController@archive');
Route::post('messages', 'PagesController@saveMessage');