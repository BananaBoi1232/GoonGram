<?php

use App\Http\Controllers\LogoutController;
use App\Http\Controllers\viewController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountControllerApiController;

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

Route::get('/home', [viewController::class, 'showHome']);
Route::get('/bannedUsers', [viewController::class, 'showBannedUsers']);
Route::get('/blockedUsers', [viewController::class, 'showBlockedUsers']);
Route::post('/createPost', [viewController::class, 'showCreatePost']);
Route::get('/directMessage', [viewController::class, 'showDirectMessage']);
Route::get('/friends', [viewController::class, 'showFriends']);
Route::get('/', [viewController::class, 'showLogin']);
Route::get('/manageAccount', [viewController::class, 'showManageAccount']);
Route::get('/messages', [viewController::class, 'showMessages']);
Route::get('/otherAccount', [viewController::class, 'showOtherAccount']);
Route::get('/personalAccount', [viewController::class, 'showPersonalAccount']);
Route::get('/reportedPosts', [viewController::class, 'showReportedPosts']);
Route::get('/search', [viewController::class, 'showSearch']);
Route::get('/settings', [viewController::class, 'showSettings']);
Route::get('/signup', [viewController::class, 'showSignup']);
Route::get('/logout', [LogoutController::class, 'logout']);

Route::post('/login', [LoginController::class, 'login']);
Route::post('/update', [AccountControllerApiController::class, 'updateAccount']);