<?php

use Illuminate\Support\Facades\Route;

Route::post('comment/store/{slug}','Users\CommentController@store')->name('comment.store');

Route::get('contact','Users\IndexController@contact')->name('contact');
Route::post('contact','Users\IndexController@docontact')->name('docontact');
Route::get('/posts/search','Users\PostController@search')->name('posts.search');
Route::get('/category/{slug}','Users\PostController@category')->name('posts.category');

Route::resource('posts', 'Users\PostController');

Route::get('/{slug}','Users\IndexController@page')->name('page');
Auth::routes();
