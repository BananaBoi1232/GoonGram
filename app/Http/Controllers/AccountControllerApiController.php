<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AccountControllerApiController extends Controller
{
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
            'profilePicture'=>' ',
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
        $file = $request->file($request->profilePicture);
        echo $path = $request->file('file')->store('img');

        // $account = DB::table('acounts')->where('email', $request->email['email'])->update(['profilePicture' => $request->profilePicture]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        

    }
}
