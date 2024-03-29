<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Post;

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
        $postId = $request->input('postId');

        $post = Post::find($postId);

        $post->likeCount += 1;

        $post->save();

        return response()->json(['success' => true]);
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
