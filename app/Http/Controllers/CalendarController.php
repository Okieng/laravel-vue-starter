<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feed;
use Inertia\Inertia;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $events = Feed::query()
            ->where('type', 'event')
            ->with(['user', 'followers'])
            ->withExists(['followers as is_followed' => function ($query) use ($request) {
                $query->where('user_id', $request->user()->id);
            }])
            ->latest()
            ->get();

        return Inertia::render('Calendar', [
            'events' => $events,
        ]);
    }

    public function toggleFollow(Request $request, Feed $feed)
    {
        $feed->followers()->toggle($request->user()->id);

        return back();
    }
}
