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
});

// Comment Routes
Route::post('comment/store/{slug}','Users\CommentController@store')->name('comment.store');

// Contact Routes
Route::get('/contact','Users\IndexController@contact')->name('contact');
Route::post('/contact','Users\IndexController@docontact')->name('docontact');

// Category Routes
Route::get('/category/{slug}','Users\PostController@category')->name('posts.category');

// Archive Routes
Route::get('/archive/{date}','Users\PostController@archive')->name('posts.archive');

// Author Routes
Route::get('/author/{username}','Users\PostController@author')->name('posts.author');

// Posts Routes
Route::get('/posts/search','Users\PostController@search')->name('posts.search');
Route::get('/', 'Users\PostController@index')->name('index');
Route::resource('posts', 'Users\PostController');

// Static Pages Routes
Route::get('/{slug}','Users\IndexController@page')->name('page');

