<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function bookNow(Request $request)
    {
        $validated  =   $request->validate([
            'venue_id'  =>  'required|exists:venue,id',
            'booking_date'  =>  'required|date|after_or_equal:today|before_or_equal:'. now()->addMonth()->toDateString(),
            'start_time'    =>  'required|date_format:H:i:s',
            'end_time'  =>  'required|date_format:H:i:s|after:start_time'
        ]);

        $venue  =   Venue::find($request->venue_id);

        if($request->start_time < $venue->open_time || $request->end_time > $venue->close_time)
        {
            return response([
                'message'   =>  'invalid working hours!'
            ],200);
        }
    }
}
