<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Photo;


class AccountControllerApiController extends Controller
{   
    public function updateAccount(Request $request){
        $name = $request->file('profilePicture')->getClientOriginalName();
        $size = $request->file('profilePicture')->getSize();

        $request->file('profilePicture')->store('public/storage/img/');
        $photo = new Photo();
        $photo->name = $name;
        $photo->size = $size;
        $photo->save();
        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $account = [
            'username' => $request->username,
            'password' => $request->password,
            'email'=> $request->email,
            'name'=> $request->name,
            'accountType'=>'user',
            'bio'=>' ',
            'followingCount'=>0,
            'followerCount'=>0,
            'private'=>0
        ];
        if ($this->emailExists($account['email'])) {
            echo "<script>alert('Email already exists. Please use a different email address.');</script>";
            return view("signup"); 
        }
        User::create($account);
        return redirect('/');
    }

    public function emailExists($email)
    {
        $user = DB::table('users')->where('email', $email)->first();
        return $user !== null;
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {   
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        

    }
}
