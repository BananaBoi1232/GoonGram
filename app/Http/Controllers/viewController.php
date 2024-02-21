<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class viewController extends Controller
{
    public function registrationApprovalShow(){
        $query = DB::select("SELECT * FROM accounts WHERE email");
        return view("manageAccount",["query"=>$query]);
    }

    public function showHome(Request $request)
    {
        return view('home', [
            'user' => auth()->user()
        ]);
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
        return view('createPost', [
            'user' => auth()->user()
        ]);
    }

    public function showDirectMessage(){
        return view('directMessage', [
            'user' => auth()->user()
        ]);
    }

    public function showFriends(){
        return view('friends', [
            'user' => auth()->user()
        ]);
    }

    public function showLogin(){
        return view ('login');
    }

    public function showManageAccount(){
        return view('manageAccount', [
            'user' => auth()->user()
        ]);
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
            return view('personalAccount', [
                'user' => auth()->user()
        ]);
    }

    public function showReportedPosts(){
        if(true == true){
            return view('reportedPosts');
        } else {
            return redirect()->back();
        }
    }

    public function showSearch(){
        return view('search', [
            'user' => auth()->user()
        ]);
    }

    public function showSettings(){
        return view('settings', [
            'user' => auth()->user()
        ]);
    }
}
