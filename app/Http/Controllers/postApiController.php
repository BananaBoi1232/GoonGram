<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Post;

use function Laravel\Prompts\alert;

class postApiController extends Controller
{
    public function createPost(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'image' =>['required', 'string', 'max:255'],
            'caption' => ['required', 'string', 'max:255']
        ]);

        $imagePath = 'storage'.auth()->user()->postImage;

        if($request->hasFile('image')) {
            if(File::exists($imagePath)) {
                File::delete($imagePath);
            }

            $image = $request->image->store('images', 'public');
        }

        DB::table('posts')->insert([
            'userID' => auth()->user()->id,
            'caption' => $request->caption,
            'likeCount' => 0,
            'postImage' => $image
        ]);

        return response()->json(['code' => 200, 'msg' => 'Post Successfully Created']);

    }

    public function like(Request $request){
        $check = DB::table('likes')->where('postID', $request->postID)->where('userID', auth()->user()->id)->first();
        
        if(is_null($check)){
            DB::table('likes')->insert(['postID' => $request->postID, 'userID' => auth()->user()->id]);
            DB::table('posts')->where('postID', $request->postID)->increment('likeCount', 1);
            $likeCount = DB::table('posts')->where('postID', $request->postID)->value('likeCount');
            return response()->json(['message' => 'Liked', 'action' => 'like', 'likeCount' => $likeCount], 200);
        }else{
            DB::table('likes')->where('postID', $request->postID)->where('userID', auth()->user()->id)->delete();
            DB::table('posts')->where('postID', $request->postID)->decrement('likeCount', 1);
            $likeCount = DB::table('posts')->where('postID', $request->postID)->value('likeCount');
            return response()->json(['message' => 'Unliked', 'action' => 'unlike', 'likeCount' => $likeCount], 200);
        }
    }

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
     //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
