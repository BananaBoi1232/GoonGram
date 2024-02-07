<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/bannedUsers', function () {
    return view('bannedUsers');
});

Route::get('/blockedUsers', function () {
    return view('blockedUsers');
});

Route::get('/createPost', function () {
    return view('createPost');
});


Route::get('/directMessage', function () {
    return view('directMessage');
});


Route::get('/friends', function () {
    return view('friends');
});


Route::get('/login', function () {
    return view('login');
});


Route::get('/manageAccount', function () {
    return view('manageAccount');
});


Route::get('/messages', function () {
    return view('messages');
});


Route::get('/otherAccount', function () {
    return view('otherAccount');
});


Route::get('/personalAccount', function () {
    return view('personalAccount');
});

Route::get('/reportedPosts', function () {
    return view('reportedPosts');
});


Route::get('/search', function () {
    return view('search');
});


Route::get('/settings', function () {
    return view('settings');
});


Route::get('/signup', function () {
    return view('signup');
});


