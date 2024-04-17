<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follower;
use App\Models\Post;
use App\Models\Comment;

class viewController extends Controller
{
    public function registrationApprovalShow(){
        $query = DB::select("SELECT * FROM accounts WHERE email");
        return view("manageAccount",["query"=>$query]);
    }

    public function showHome(Request $request){
        if(Auth::check()){
            $query = DB::table('users')
            ->join('posts', 'users.id', '=', 'posts.userID')
            ->select('users.*', 'posts.postID', 'posts.caption', 'posts.tagID', 'posts.likeCount', 'posts.postImage')
            ->get();
            $liked = Like::where('userID', auth()->user()->id)->pluck('postID');

            return view('home', [
                'user' => auth()->user(),
                'posts' => $query,
                'liked' => $liked,
            ]);
        } else {
            return redirect()->back()->withErrors(['You are not logged in!']);
        }
    }
    
    public function showBannedUsers(){
        if(Auth::check()){
            return view('bannedUsers');
        } else {
            return redirect()->back();
        }
    }

    public function showBlockedUsers(){
        if(Auth::check()){
            return view('blockedUsers');
        } else {
            return redirect()->back();
        }
    }

    public function showCreatePost(){
        if(Auth::check()){
            return view('createPost', [
                'user' => auth()->user()
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function showDirectMessage(){
        if(Auth::check()){
            return view('directMessage', [
            'user' => auth()->user() 
        ]);
        } else {
            return redirect()->back();
        }

    }

    public function showFriends(){
        if(Auth::check()){
            return view('friends', [
                'user' => auth()->user()
            ]);
        } else {
            return redirect()->back();
        }

    } 

    public function showLogin(){
        return view ('login');
    }

    public function showManageAccount(){
        if(Auth::check()){
            $user = auth()->user();
            return view('manageAccount', [
                'user' => $user,
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function showMessages(){
        if(Auth::check()){
            return view('messages');
        } else {
            return redirect()->back();
        }
    }

    public function showOtherAccount($id){
        $user = User::find($id);
        $query = DB::table('posts')->where('userID', '=', $user->id)->get();
        $followed = Follower::where('followerID', auth()->user()->id)->pluck('personFollowedID');
        $liked = Like::where('userID', auth()->user()->id)->pluck('postID');

        if(Auth::check()){
            if($user->id == auth()->user()->id){
                return view('personalAccount', [
                    'user' => auth()->user(),
                    'posts' => $query,
                    'liked' => $liked,
                ]);
            }else{
                return view('otherAccount')->with('user', $user)->with('posts', $query)->with('followed', $followed)->with('liked', $liked);
            }
        } else {
            return redirect()->back();
        }
    }

    public function showComments($postID){
        $post = DB::table('users')
        ->join('posts', 'users.id', '=', 'posts.userID')
        ->select('users.*', 'posts.*')
        ->where('posts.postID', $postID)
        ->first();
        $comments = DB::table('users')
        ->join('comments', 'users.id', '=', 'comments.sender')
        ->select('users.*', 'comments.*')
        ->where('comments.postID', $postID)
        ->get();

        if(Auth::check()){
            return view('comments')->with('post', $post)->with('comments', $comments);
        }else{ 
            return redirect()->back();
        }
    }

    public function showPersonalAccount(){
        if(Auth::check()){
            $query = DB::table('posts')->where('userID', '=', auth()->user()->id)->get();
            $liked = Like::where('userID', auth()->user()->id)->pluck('postID');
            return view('personalAccount', [
                'user' => auth()->user(),
                'posts' => $query,
                'liked' => $liked,
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function showReportedPosts(){
        if(Auth::check()){
            return view('reportedPosts');
        } else {
            return redirect()->back();
        }
    }

    public function showSearch(){
        if(Auth::check()){
            $searchUsers = DB::table('users')
                ->get();
            $searchPosts = DB::table('posts')
                ->get();
            $searchTags = DB::table('tags')
                ->get();
            return view('search', [
                'user' => auth()->user(),
                'searchUsers' => $searchUsers,
                'searchPosts' => $searchPosts,
                'searchTags' => $searchTags
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function showSettings(){
        if(Auth::check()){
            return view('settings', [
                'user' => auth()->user()
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function showSignup(){
        return view('signup');
    }
}
