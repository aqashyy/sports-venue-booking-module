<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    public function listVenues()
    {
        $venues = Venue::withCount('bookings')->get();

        $highestBookings = $venues->max('bookings_count');
        $lowestBookings = $venues->min('bookings_count');

        $response = $venues->map(function ($venue) use ($highestBookings, $lowestBookings) {
            return [
                'name' => $venue->name,
                'open_time' => $venue->open_time,
                'close_time' => $venue->close_time,
                'bookings_count' => $venue->bookings_count,
                'is_highest' => match($venue->bookings_count) {
                    $highestBookings => "Highest",
                    $lowestBookings => "Lowest",
                    default => "Normal",
                },
            ];
        });
        return response()->json($response);
    }
    
}
