<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\User;


class AccountControllerApiController extends Controller
{   
    public function updateAccount(Request $request){
        $validated = Validator::make($request->all(), [
            'bio' =>['required', 'string', 'max:255'],
            'private' => ['required', 'int', 'max:1'],
        ]);


        $imagePath = 'storage'.auth()->user()->profilePicture;
        if($request->hasFile('image')) {
            if(File::exists($imagePath)) {
                File::delete($imagePath);
            }

            $image = $request->image->store('images', 'public');

        }

        DB::table('users')->where('id' , auth()->user()->id)->update([
            'bio' => $request->bio, 
            'private' => $request->private, 
            'profilePicture' => $image ?? auth()->user()->profilePicture,
        ]);

        return response()->json(['code' => 200, 'msg' => 'profile updated successfully']);

    }

    public function ban(Request $request){
        $check = DB::table('bannedUsers')->where('userID', $request->userID)->first();

        if(is_null($check)){
            DB::table('bannedUsers')->insert(['userID' => $request->userID]);
            return response()->json(['message' => 'User has been banned', 200]);
        } else {
            return response()->json(['message' => 'Error user is already banned', 200]);
        }
    }

    public function unban(Request $request){
        $check = DB::table('bannedUsers')->where('userID', $request->userID)->first();

        if(is_null($check)){
            return response()->json(['message' => 'User is not banned', 200]);
        } else {
            DB::table('bannedUsers')->where('userID', $request->userID)->delete();
            return response()->json(['message' => 'User has been unbanned', 200]);
        }
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
