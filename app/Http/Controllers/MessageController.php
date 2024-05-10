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
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return response()->json(['message' => 'Message Sent'], 200);
    }

    public function fetchMessages($dmId) {
        $messages = DB::table('messages')
            ->where('dmID', $dmId)
            ->get();
        return response()->json([
            'messages' => $messages,
        ]);
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
