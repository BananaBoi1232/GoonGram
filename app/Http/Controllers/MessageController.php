<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\DirectMessage;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        // Create a new DirectMessage with pending approval
        $directMessage = DirectMessage::create([
            'firstUser' => auth()->id(),
            'secondUser' => $request->receiver_id,
            'approved' => false
        ]);

        // Create the message associated with the DirectMessage
        $message = new Message();
        $message->dmID = $directMessage->dmID;
        $message->messageSender = auth()->id();
        $message->message = $request->message;
        $message->save();

        return redirect()->back()->withSuccess('Message sent successfully');
    }

    public function getMessages()
    {
        $user = auth()->user();

        // Get pending messages to be approved
        $pendingMessages = DirectMessage::where('secondUser', $user->id)
            ->where('approved', false)
            ->with('messages')
            ->get();

        // Get approved messages for ongoing conversations
        $approvedMessages = DirectMessage::where(function ($query) use ($user) {
            $query->where('firstUser', $user->id)
                ->orWhere('secondUser', $user->id);
        })
            ->where('approved', true)
            ->with('messages')
            ->get();

        return view('messages.index', compact('pendingMessages', 'approvedMessages'));
    }

    public function approveMessage(DirectMessage $directMessage)
    {
        // Approve the pending message
        $directMessage->update(['approved' => true]);

        return redirect()->back()->withSuccess('Message approved successfully');
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
