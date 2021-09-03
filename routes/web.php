<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



// Authentication Routes
Auth::routes();

// New User Verification
Route::get('/email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::post('/email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

// User Dashboard
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', 'Users\UserController@index')->name('dashboard');
    Route::get('/dashboard/comments', 'Users\CommentController@index')->name('dashboard.comments');
    Route::get('/dashboard/edit-information', 'Users\UserController@edit')->name('dashboard.edit_info');
    Route::post('/dashboard/destroy_avatar', 'Users\UserController@destroy_avatar')->name('user.image.destroy');
    Route::put('/dashboard/user/update_password', 'Users\UserController@update_password')->name('user.update.password');

});

// Comments Routes
Route::resource('comments', 'Users\CommentController')->except(['show','create']);

// Contact Routes
Route::get('/contact','Users\IndexController@contact')->name('contact');
Route::post('/contact','Users\IndexController@docontact')->name('docontact');

// Category Routes
Route::get('/category/{slug}','Users\PostController@category')->name('posts.category');

// Archive Routes
Route::get('/archive/{date}','Users\PostController@archive')->name('posts.archive');

// Author Routes
Route::resource('user','Users\UserController')->only(['index','edit','update']);
Route::get('/author/{username}','Users\PostController@author')->name('posts.author');

// Posts Routes
Route::get('/posts/search','Users\PostController@search')->name('posts.search');
Route::get('/', 'Users\PostController@index')->name('index');
Route::resource('posts', 'Users\PostController');

// Delete Post Media
Route::post('/posts/media/{media}/delete','Users\PostMediaController@destroy')->name('posts.media.destroy');

// Static Pages Routes
Route::get('/#/{slug}','Users\IndexController@page')->name('page');

