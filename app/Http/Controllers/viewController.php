<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follower;
use App\Models\DirectMessage;


class viewController extends Controller
{
    public function registrationApprovalShow(){
        $query = DB::select("SELECT * FROM accounts WHERE email");
        return view("manageAccount",["query"=>$query]);
    }

    public function showHome(Request $request){
        $query = DB::table('bannedUsers')->where('userID', auth()->user()->id)->first();
        if(is_null($query)){
            if(Auth::check()){
                $query = DB::table('users')
                ->join('posts', 'users.id', '=', 'posts.userID')
                ->select('users.*', 'posts.postID', 'posts.caption', 'posts.likeCount', 'posts.postImage')
                ->get();
                $liked = Like::where('userID', auth()->user()->id)->pluck('postID');
                $followed = Follower::where('followerID', auth()->user()->id)->pluck('personFollowedID');
    
                return view('home', [
                    'user' => auth()->user(),
                    'posts' => $query,
                    'liked' => $liked,
                    'followed' => $followed,
                ]);
            } else {
                return redirect()->back()->withErrors(['You are not logged in!']);
            }
        } else {
            return redirect()->back()->withErrors(['This user is banned']);
        }
    }

    public function showReportedPosts(){
        if(Auth::check()){

            //Query for reported posts and their data
            $query = DB::table('reported_posts')
            ->join('posts', 'reported_posts.postID', '=', 'posts.postID')
            ->join('users', 'posts.userID', '=', 'users.id')
            ->select('posts.*', 'users.*', 'reported_posts.*')
            ->get();

            //Returns the view with query results 
            return view('reportedPosts')->with('reportedPosts', $query);

        } else {
            return redirect()->back();
        }
    }
    
    public function showBannedUsers(){
        if(Auth::check()){
            $query = DB::table('users')
            ->get();
            $banned = DB::table('bannedUsers')
            ->get();
            return view('bannedUsers', [
                'userInfo' => $query,
                'bannedUsers' => $banned,
            ]);
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
            //Query for open all existing dms
            $query = DB::table('direct_messages as d')
                ->select('d.dmID', 'a.id as firstId', 'a.username as firstUsername', 'a.profilePicture as firstPfp', 'b.id as secondId', 'b.username as secondUsername', 'b.profilePicture as secondPfp')
                ->leftJoin('users as a', 'a.id', '=', 'd.firstUser')
                ->leftJoin('users as b', 'b.id', '=', 'd.secondUser')
                ->where(function($query) {
                    $query->where('d.firstUser', auth()->user()->id)
                    ->orWhere('d.secondUser', auth()->user()->id);
                })
                ->get();
            return view('directMessage', [
            'user' => auth()->user(),
            'results' => $query,
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

    public function showMessages($id){
        if(Auth::check()){
            //you
            $user = auth()->user();

            //other person
            $other = User::find($id);

            $dm = DB::table('direct_messages')
            ->where(function ($query) use ($user, $other) {
                $query->where('firstUser', $user->id)
                      ->where('secondUser', $other->id);
            })
            ->orWhere(function ($query) use ($user, $other) {
                $query->where('firstUser', $other->id)
                      ->where('secondUser', $user->id);
            })
            ->first();

            if(is_null($dm)){
                $dmId = DB::table('direct_messages')->insertGetId([
                    'firstUser' => $user->id, 
                    'secondUser' => $other->id, 
                    'approved' => 1
                ]);
                $dm = DB::table('direct_messages')->where('dmID', $dmId)->first();
            }

            $messages = DB::table('messages')
                ->where('dmID', $dm->dmID)
                ->get();

            return view('messages')->with('messages', $messages)->with('dmId', $dm->dmID)->with('user', $user);

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

    public function showSearch(){
        if(Auth::check()){
            $searchUsers = DB::table('users')
                ->get();
            $searchPosts = DB::table('posts')
                ->join('users', 'posts.userID', '=', 'users.id')
                ->select('users.*', 'posts.*')
                ->get();
            $searchTags = DB::table('tags')
                ->get();
            $followed = Follower::where('followerID', auth()->user()->id)->pluck('personFollowedID');
            return view('search', [
                'user' => auth()->user(),
                'searchUsers' => $searchUsers,
                'searchPosts' => $searchPosts,
                'searchTags' => $searchTags,
                'followed' => $followed
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
