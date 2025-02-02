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

    public function rankVenues()
    {
        $startOfMonth   =   now()->startOfMonth()->format('d-m-Y');
        $endOfMonth     =   now()->endOfMonth()->format('d-m-Y');

        $venues     =   Venue::withCount([
            'bookings'  =>  function ($query) use ($startOfMonth,$endOfMonth) {
                $query->whereBetween('booking_date', [$startOfMonth, $endOfMonth]);
            }
        ])->get();

        // dd($venues);

        $res    =   $venues->map(function ($venue) {
            $rank   =   match (true) {
                $venue->bookings_count >    15  =>  "A",
                $venue->bookings_count >=   10  =>  "B",
                $venue->bookings_count >=   5   =>  "C",
                default                         =>  "D",
            };

            return [
                'venue_id'          =>  $venue->id,
                'name'              =>  $venue->name,
                'bookings_count'    =>  $venue->bookings_count,
                'rank'              =>  $rank
            ];
        });

        return response()->json($res);
    }
    
}
