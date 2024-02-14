<?php

namespace App\Http\Controllers;

use App\Models\account_controller_api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Account;

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
            'pass' => $request->pass,
            'email'=> $request->email,
            'accountType'=>'user',
            'bio'=>' ',
            'profilePicture'=>' '
        ];
        if ($this->emailExists($account['email'])) {
            echo "<script>alert('Email already exists. Please use a different email address.');</script>";
            return view("signup"); 
        }
        account::create($account);
        return view("login");
    }

    public function emailExists($email)
    {
        $user = DB::table('accounts')->where('email', $email)->first();
        return $user !== null;
    }

    /**
     * Display the specified resource.
     */
    public function show(account_controller_api $account_controller_api)
    {
        

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, account_controller_api $account_controller_api)
    {
        $file = $request->file($request->profilePicture);
        echo $path = $request->file('file')->store('img');

        // $account = DB::table('acounts')->where('email', $request->email['email'])->update(['profilePicture' => $request->profilePicture]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(account_controller_api $account_controller_api)
    {
        

    }
}
