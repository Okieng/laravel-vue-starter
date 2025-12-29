<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feed;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Feed $feed)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $comment = $feed->comments()->create([
            'user_id' => Auth::id(),
            'content' => $validated['content'],
            'feed_id' => $feed->id,
        ]);

        $feed->increment('comments_count');

        broadcast(new \App\Events\CommentCreated($comment))->toOthers();

        return redirect()->back()->with('success', 'Comment added successfully');
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== Auth::id()) {
            abort(403);
        }

        $feed = $comment->feed;
        $comment->delete();
        $feed->decrement('comments_count');

        return redirect()->back()->with('success', 'Comment deleted successfully');
    }
}
