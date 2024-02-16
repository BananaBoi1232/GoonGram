<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function registrationApprovalShow(){
        $query = DB::select("SELECT * FROM accounts WHERE email");
        return view("manageAccount",["query"=>$query]);
    }

    public function showHome(){
        return view('home');
    }

    public function showBannedUsers(){
        if(true == true){
            return view('bannedUsers');
        } else {
            return redirect()->back();
        }
    }

    public function showBlockedUsers(){
        if(true == true){
            return view('blockedUsers');
        } else {
            return redirect()->back();
        }
    }

    public function showCreatePost(){
        if(true == true){
            return view('createPost');
        } else {
            return redirect()->back();
        }
    }

    public function showDirectMessage(){
        if(true == true){
            return view('directMessage');
        } else {
            return redirect()->back();
        }
    }

    public function showFriends(){
        if(true == true){
            return view('friends');
        } else {
            return redirect()->back();
        }
    }

    public function showLogin(){
        return view ('login');
    }

    public function showManageAccount(){
        if(true == true){
            return view('manageAccount');
        } else {
            return redirect()->back();
        }
    }

    public function showMessages(){
        if(true == true){
            return view('messages');
        } else {
            return redirect()->back();
        }
    }

    public function showOtherAccount(){
        if(true == true){
            return view('otherAccount');
        } else {
            return redirect()->back();
        }
    }

    public function showPersonalAccount(){
        if(true == true){
            return view('personalAccount');
        } else {
            return redirect()->back();
        }
    }

    public function showReportedPosts(){
        if(true == true){
            return view('reportedPosts');
        } else {
            return redirect()->back();
        }
    }

    public function showSearch(){
        if(true == true){
            return view('search');
        } else {
            return redirect()->back();
        }
    }

    public function showSettings(){
        if(true == true){
            return view('settings');
        } else {
            return redirect()->back();
        }
    }

    public function showSignup(){
        if(true == true){
            return view('signup');
        } else {
            return redirect()->back();
        }
    }
}
