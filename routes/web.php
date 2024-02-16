<?php

use App\Http\Controllers\ViewController;
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

Route::get('/', [ViewController::class, 'showHome']);
Route::get('/bannedUsers', [ViewController::class, 'showBannedUsers']);
Route::get('/blockedUsers', [ViewController::class, 'showBlockedUsers']);
Route::get('/createPost', [ViewController::class, 'showCreatePost']);
Route::get('/directMessage', [ViewController::class, 'showDirectMessage']);
Route::get('/friends', [ViewController::class, 'showFriends']);
Route::get('/login', [ViewController::class, 'showLogin']);
Route::get('/manageAccount', [ViewController::class, 'showManageAccount']);
Route::get('/messages', [ViewController::class, 'showMessages']);
Route::get('/otherAccount', [ViewController::class, 'showOtherAccount']);
Route::get('/personalAccount', [ViewController::class, 'showPersonalAccount']);
Route::get('/reportedPosts', [ViewController::class, 'showReportedPosts']);
Route::get('/search', [ViewController::class, 'showSearch']);
Route::get('/settings', [ViewController::class, 'showSettings']);
Route::get('/signup', [ViewController::class, 'showSignup']);