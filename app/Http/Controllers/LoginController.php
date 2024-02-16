<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Account;

class LoginController extends Controller
{
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
        $email = $request->all('email');
        if(DB::table('accounts')->select('email')->where('email','=',$email)->get() == '[]'){
            return view('login',['error' => 'No Account found with such email!']);
        }
        else{
            $account = DB::table('accounts')->select('userID','accountType','email','password')->where('email','=',$email)->get()[0];
        }


        $password = $request->all('password')['password'];

        if($password == $account->password){


        }

        else{
            return view('login',['error'=>'Incorrect Password!']);
        }
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
