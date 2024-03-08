<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;

class postApiController extends Controller
{
    private $error = "";

    public function create_post($userid, $data)
    {
    // creating and sending the post to the DB.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Handle form submission

        if (!empty($_POST['_token'])) {
    
            // Process form data
            $postImage = $_FILES['postImage']; // Uploaded file
            $caption = $_POST['caption'];
            $tag = $_POST['tag'];

            DB::table('posts')->where('postID' , auth()->user()->postID)->update([
                'postImage' => $request->postImage, 
                'caption' => $request->caption, 
                'userID' => 
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
        //
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
