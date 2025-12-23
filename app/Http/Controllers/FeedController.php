<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feed;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    public function index()
    {
        return Feed::with('user')->latest()->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|in:post,event,project_update,social',
            'content' => 'required|string',
            'title' => 'nullable|string',
            'event_date' => 'nullable|date',
            'images' => 'nullable|array',
            'file_attachment' => 'nullable|array',
            'is_pinned' => 'boolean',
        ]);

        $feed = $request->user()->feeds()->create($validated);

        return redirect()->back()->with('success', 'Feed created successfully');
    }
}
