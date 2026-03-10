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
            'receiver_id' => 'nullable|array',
            'is_pinned' => 'boolean',
        ]);

        $feed = $request->user()->feeds()->create($validated);

        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $originalName = $image->getClientOriginalName();
                $path = $image->storeAs('feeds', $originalName, 'public');
                $imagePaths[] = $path;
            }
            $feed->images = $imagePaths;
        }

        if ($request->hasFile('file_attachment')) {
            $attachmentPaths = [];

            foreach ($request->file('file_attachment') as $file) {
                $originalName = $file->getClientOriginalName();
                $path = $file->storeAs('attachments', $originalName, 'public');
                $attachmentPaths[] = $path;
            }

            $feed->file_attachment = $attachmentPaths;
        }

        $feed->save();

        return redirect()->back()->with('success', 'Feed created successfully');
    }
}
