<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\DirectMessage;
use App\Models\Post;
use App\Models\User;

class MessageController extends Controller
{
    
    function newMessage(Request $request){
        DB::table('messages')->insert([
            'dmID' => $request->dmID, 
            'messageSender' => auth()->user()->id,
            'message' => $request->message,
        ]);
        return response()->json(['message' => 'Message Sent'], 200);
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
