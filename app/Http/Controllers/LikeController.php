<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feed;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggle(Request $request, Feed $feed)
    {
        $userId = Auth::id();
        $like = Like::where('user_id', $userId)->where('feed_id', $feed->id)->first();

        if ($like) {
            $like->delete();
            $feed->decrement('likes_count');
            $status = 'unliked';
        } else {
            Like::create([
                'user_id' => $userId,
                'feed_id' => $feed->id,
            ]);
            $feed->increment('likes_count');
            $status = 'liked';
        }

        broadcast(new \App\Events\LikeToggled($feed->id, $feed->likes_count))->toOthers();

        return redirect()->back()->with('status', $status);
    }
}
