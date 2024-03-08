<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;

class postApiController extends Controller
{
    private $error = "";

    public function create_post(Request $request)
    {
    // creating and sending the post to the DB.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Handle form submission

        if (!empty($_POST['_token'])) {

    
            // Process form data
            $caption = $_POST['caption'];
            $tag = $_POST['tag'];
            $postImage = $_FILES['postImage']; // Uploaded file

            //Send to DB
            DB::table('posts')->update([
                'caption' => $caption,
                'tagID' => $tag,
                'postImage' => $postImage
            ]);



            // Send response to the frontend
            $response = ['code' => 200, 'msg' => 'Post created successfully'];
            echo json_encode($response);
            exit;

        } else {
            $response = ['code' => 400, 'msg' => 'CSRF token validation failed'];
            echo json_encode($response);
            exit;
        }
    } else {

        http_response_code(405);
        exit('Method Not Allowed');
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
        $posts = [
            'postID' => $request->postID,
            'userID' => $request->userID,
            'caption' => $request->caption,
            'tagID' => null,
            'likeCount' => 0,
            'postImage' =>$request->postImage

        ];

        Post::create_post($posts);

        
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
