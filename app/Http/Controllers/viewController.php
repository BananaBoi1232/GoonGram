<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class viewController extends Controller
{
    public function registrationApprovalShow(){
        $query = DB::select("SELECT * FROM accounts WHERE email");
        return view("manageAccount",["query"=>$query]);
    }

    public function showHome(Request $request){
        if(Auth::check()){
            return view('home', [
                'user' => auth()->user()
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
        if(Auth::check()){        return view('directMessage', [
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
            return view('manageAccount', [
                'user' => auth()->user()
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

    public function showOtherAccount(){
        if(Auth::check()){
            return view('otherAccount');
        } else {
            return redirect()->back();
        }
    }

    public function showPersonalAccount(){
        if(Auth::check()){
            return view('personalAccount', [
                'user' => auth()->user()
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
            return view('search', [
                'user' => auth()->user()
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
