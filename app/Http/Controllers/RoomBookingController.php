<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomBooking;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\ValidationException;

class RoomBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $year = $request->input('year', now()->year);
        $month = $request->input('month', now()->month);

        $bookings = RoomBooking::with(['room', 'user'])
            ->whereYear('start_time', $year)
            ->whereMonth('start_time', $month)
            ->orderBy('start_time')
            ->get();

        return Inertia::render('RoomBookings/Index', [
            'bookings' => $bookings,
            'currentDate' => [
                'year' => (int) $year,
                'month' => (int) $month,
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $rooms = Room::all();

        if ($request->has(['start_time', 'end_time'])) {
            $start = $request->input('start_time');
            $end = $request->input('end_time');

            $rooms->transform(function ($room) use ($start, $end) {
                $booking = RoomBooking::with('user')
                    ->where('room_id', $room->id)
                    ->where(function ($query) use ($start, $end) {
                        $query->whereBetween('start_time', [$start, $end])
                            ->orWhereBetween('end_time', [$start, $end])
                            ->orWhere(function ($q) use ($start, $end) {
                                $q->where('start_time', '<=', $start)
                                    ->where('end_time', '>=', $end);
                            });
                    })
                    ->first();

                if ($booking) {
                    $room->is_booked = true;
                    $room->booked_by = $booking->user->name;
                    $room->event_name = $booking->event_name;
                } else {
                    $room->is_booked = false;
                }

                return $room;
            });
        }

        return Inertia::render('RoomBookings/Create', [
            'rooms' => $rooms,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'event_name' => 'required|string|max:255',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
        ]);

        // Check for overlaps
        $overlap = RoomBooking::where('room_id', $validated['room_id'])
            ->where(function ($query) use ($validated) {
                $query->whereBetween('start_time', [$validated['start_time'], $validated['end_time']])
                    ->orWhereBetween('end_time', [$validated['start_time'], $validated['end_time']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('start_time', '<=', $validated['start_time'])
                            ->where('end_time', '>=', $validated['end_time']);
                    });
            })
            ->exists();

        if ($overlap) {
            throw ValidationException::withMessages([
                'start_time' => 'The room is already booked for this time slot.',
            ]);
        }

        $request->user()->roomBookings()->create($validated);

        return redirect()->route('room-bookings.index')->with('success', 'Room booked successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomBooking $roomBooking)
    {
        // Optional: specific authorization policy can be added here
        $roomBooking->delete();

        return redirect()->route('room-bookings.index')->with('success', 'Booking cancelled successfully.');
    }
}
