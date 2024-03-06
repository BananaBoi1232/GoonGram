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
    public function store($userid, $data)
    {
    // creating and sending the post to the DB.
       if(!empty($data['post']))
       {

            $post = addslashes($data['post']);
            $postID = $this->create_postid();

            $query = "insert into posts (userid,postID,post) values ('$userid','$postID','$post')";

            $DB = new Database();
            $DB ->save($query);
       }
       else
       {
            $this->error .= "Please type something to post!<br>";
       }
       return $this->error;

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if($_SERVER['REQUEST_METHOD']== "POST")
        {

            $post = new Post();
            $post ->store($userid, $data);
            print_r($_POST);
        }
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
