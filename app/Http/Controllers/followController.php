<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class followController extends Controller
{
    function follow(Request $request){
        $check = DB::table('followers')->where('personFollowedID', $request->userID)->where('followerID', auth()->user()->id)->first();
        
        if(is_null($check)){
            DB::table('followers')->insert(['personFollowedID' => $request->userID, 'followerID' => auth()->user()->id, 'approved' => 1]);

            DB::table('users')->where('id', $request->userID)->increment('followerCount', 1);

            DB::table('users')->where('id', auth()->user()->id)->increment('followingCount', 1);

            $followerCount = DB::table('users')->where('id', $request->userID)->value('followerCount');

            return response()->json(['message' => 'follow', 'action' => 'follow', 'followerCount' => $followerCount], 200);
        }else{
            DB::table('followers')->where('personFollowedID', $request->userID)->where('followerID', auth()->user()->id)->delete();

            DB::table('users')->where('id', $request->userID)->decrement('followerCount', 1);

            DB::table('users')->where('id', auth()->user()->id)->decrement('followingCount', 1);

            $followerCount = DB::table('users')->where('id', $request->userID)->value('followerCount');

            return response()->json(['message' => 'unfollow', 'action' => 'unfollow', 'followerCount' => $followerCount], 200);
        }    
    }
}
