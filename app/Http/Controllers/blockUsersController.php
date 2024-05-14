<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\blockedUsers;
use Illuminate\Support\Facades\DB;

class blockUsersController extends Controller
{

    public function blockUser($id)
    {
        try {

            $user = auth()->user();

            $other = User::findOrFail($id);
    
            // Prevent blocking oneself
            if ($user->id === $other->id) {
                return response()->json(['error' => 'You cannot block yourself.'], 400);
            }
    
            // Insert new block entry
            blockedUsers::create([
                'firstUser' => $user->id,
                'secondUser' => $other->id,
                'blocked' => 1
            ]);
    
            // Fetch the updated list of blocked users
            $blockedUsers = blockedUsers::where('firstUser', $user->id)
                ->orWhere('secondUser', $user->id)
                ->pluck('secondUser');
    
            // Return a success response
            return response()->json(['message' => 'User blocked successfully', 'blockedUsers' => $blockedUsers], 200);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json(['error' => 'Failed to block user.'], 500);
        }
    }
    
public function showBlockedUsers()
{
    $user = auth()->user();

    $query = DB::table('blocked_users')
    ->join('users', 'blocked_users.secondUser', '=', 'users.id')
    ->where('blocked',1)
    ->where('firstUser', $user->id)
    ->select('users.id','users.username')
    ->get();

    $blockedUserID = blockedUsers::where('secondUser','=','users.id');
    return view('blockedUsers',
    [
        'blockedUsers' => $query,
        'blockedUserID' => $blockedUserID
    ]);
}
public function unblockUser($id)
{
    $blockerID = auth()->id();
    $blockedUserID = $id;
    
    // Remove the user from the blocked_users table
    blockedUsers::where('firstUser', $blockerID)
               ->where('secondUser', $blockedUserID)
               ->delete();

    return redirect()->back()->with('success', 'User unblocked successfully!');
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
