<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $users = \App\Models\User::where('id', '!=', auth()->id())
            ->withIsActive()
            ->withCount(['sentMessages as unread_count' => function ($query) {
                $query->where('receiver_id', auth()->id())
                      ->whereNull('read_at');
            }])
            ->get();
            
        return \Inertia\Inertia::render('Chat', [
            'users' => $users
        ]);
    }

    public function show(\App\Models\User $user)
    {
        // Mark messages as read
        \App\Models\Message::where('sender_id', $user->id)
            ->where('receiver_id', auth()->id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        $messages = \App\Models\Message::where(function($query) use ($user) {
            $query->where('sender_id', auth()->id())
                  ->where('receiver_id', $user->id);
        })->orWhere(function($query) use ($user) {
            $query->where('sender_id', $user->id)
                  ->where('receiver_id', auth()->id());
        })
        ->with(['sender', 'receiver'])
        ->orderBy('created_at', 'asc')
        ->get();

        return response()->json($messages);
    }

    public function store(Request $request, \App\Models\User $user)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $message = \App\Models\Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'content' => $validated['content'],
        ]);

        return response()->json($message);
    }
}
