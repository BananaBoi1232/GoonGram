<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LogoutController;
use App\Http\Controllers\viewController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AccountControllerApiController;
use App\Http\Controllers\blockUsersController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\followController;
use App\Http\Controllers\postApiController;
use App\Http\Controllers\commentController;


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

//GET
Route::get('/', [viewController::class, 'showLogin']);
Route::get('/home', [viewController::class, 'showHome']);
Route::get('/bannedUsers', [viewController::class, 'showBannedUsers']);
Route::get('/blockedUsers', [viewController::class, 'showBlockedUsers']);
Route::get('/post', [viewController::class, 'showCreatePost']);
Route::get('/directMessage', [viewController::class, 'showDirectMessage']);
Route::get('/friends', [viewController::class, 'showFriends']);
Route::get('/manageAccount', [viewController::class, 'showManageAccount']);
Route::get('/personalAccount', [viewController::class, 'showPersonalAccount']);
Route::get('/reportedPosts', [viewController::class, 'showReportedPosts']);
Route::get('/search', [viewController::class, 'showSearch']);
Route::get('/settings', [viewController::class, 'showSettings']);
Route::get('/signup', [viewController::class, 'showSignup']);
Route::get('/logout', [LogoutController::class, 'logout']);
Route::get('/otherAccount/{id}', [viewController::class, 'showOtherAccount']);
Route::get('/comments/{postID}', [viewController::class, 'showComments']);
Route::get('/showMessages/{id}', [viewController::class, 'showMessages']);
Route::get('/blockedUsers',[blockUsersController::class,'showBlockedUsers'] );
Route::post('/blockUsers/{id}', [blockUsersController::class, 'blockUser'])->name('blockUser');
Route::delete('/unblockUser/{id}', [blockUsersController::class, 'unblockUser'])->name('unblockUser');
Route::get('/fetchMessages/{dmId}', [MessageController::class, 'fetchMessages']);

//POST
Route::post('/follow', [followController::class, 'follow']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/update', [AccountControllerApiController::class, 'updateAccount']);
Route::post('/createPost', [postApiController::class, 'createPost']);
Route::post('/like', [postApiController::class, 'like']);
Route::post('/send-message', [MessageController::class, 'sendMessage'])->name('send.message');
Route::post('/approve-message/{directMessage}', [MessageController::class, 'approveMessage'])->name('approve.message');
Route::post('/reportPost', [postApiController::class, 'reportPost']);
Route::post('/deleteReportedPost', [postApiController::class, 'deleteReportedPost']);
Route::post('/createComment', [commentController::class, 'createComment']);
Route::post('/spareReportedPost', [postApiController::class, 'spareReportedPost']);
Route::post('/newMessage', [MessageController::class, 'newMessage']);
Route::post('/ban', [AccountControllerApiController::class, 'ban']);
Route::post('/unban', [AccountControllerApiController::class, 'unban']);





