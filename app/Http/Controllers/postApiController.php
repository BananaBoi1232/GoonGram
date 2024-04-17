<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Post;
use App\Models\Pt;


use function Laravel\Prompts\alert;

class postApiController extends Controller
{
    public function createPost(Request $request)
    {   
        //Adds Tags Into An Array
        $tags = explode(' ', $request->tag);
        

        //Validate Request
        $validated = Validator::make($request->all(), [
            'image' =>['required', 'image'],
            'caption' => ['required', 'string', 'max:255']
        ]);
        if($validated->fails()){
            return response()->json(['code' => 400, 'msg' => $validated->errors()->first()]);
        }

        //Store Image
        $imagePath = 'storage'.auth()->user()->postImage;

        if($request->hasFile('image')) {
            if(File::exists($imagePath)) {
                File::delete($imagePath);
            }

            $image = $request->image->store('images', 'public');
        }

        //Adds The Post To The Database
        DB::table('posts')->insert([
            'userID' => auth()->user()->id,
            'caption' => $request->caption,
            'likeCount' => 0,
            'postImage' => $image
        ]);

        //Gets the id of the newly created post
        $newestPost = DB::Table('posts')->select('postID')->orderBy('postID', 'desc')->first();

        //Extracts the postID from the object
        $newestPostID = $newestPost->postID;


        //Adds The Tags Into The Tag Table
        $tagQuery = DB::Table('tags')->pluck('tagName')->toArray();
        foreach($tags as $tag){
            if(!in_array($tag, $tagQuery)){
                DB::table('tags')->insert(['tagName' => $tag]);
            }
        }

        //Retrieves Tag Ids
        $insertedTags = DB::table('tags')->whereIn('tagName', $tags)->pluck('tagID')->toArray();
        

        //Inserts All The Data Into The Pt Table
        foreach($insertedTags as $tag){
            DB::table('pt')->insert([
                'pt_postid' => $newestPostID,
                'pt_tagid' => $tag,
            ]);
        }

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
