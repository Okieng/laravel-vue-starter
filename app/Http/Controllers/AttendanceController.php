<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function current()
    {
        $attendance = Attendance::where('user_id', Auth::id())
            ->whereNull('check_out_time')
            ->latest()
            ->first();

        return response()->json([
            'attendance' => $attendance
        ]);
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'check_in_time' => 'required|date',
        // ]);

        $attendance = Attendance::create([
            'user_id' => Auth::id(),
            'check_in_time' => now(),
        ]);

        return response()->json([
            'message' => 'Checked in successfully',
            'attendance' => $attendance,
        ]);
    }

    public function update(Request $request, Attendance $attendance)
    {
        if ($attendance->user_id !== Auth::id()) {
            abort(403);
        }

        // $request->validate([
        //     'check_out_time' => 'required|date|after:check_in_time',
        // ]);

        $attendance->update([
            'check_out_time' => now(),
        ]);

        return response()->json([
            'message' => 'Checked out successfully',
            'attendance' => $attendance,
        ]);
    }
}
