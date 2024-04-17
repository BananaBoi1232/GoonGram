<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class commentController extends Controller
{
    public function createComment(Request $request){
        DB::table('comments')
        ->insert([
            'sender' => auth()->user()->id,
            'postID' => $request->postID,
            'commentContent' => $request->commentContent,
        ]);

        return response()->json(['code' => 200, 'msg' => 'Comment Successfully Created']);
    }
}
