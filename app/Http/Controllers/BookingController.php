<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Venue;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function bookNow(Request $request)
    {
        $message    =   [
            'venue_id.required' =>  'Venue is required!',
            'venue_id.exists'   =>  'Invalid venue!',
            'booking_date.required'  =>  'Booking date is required!',
            'booking_date.date_format'  =>  'Invalid date format!',
            'booking_date.after_or_equal'   =>  'Booking date should be today or later!',
            'booking_date.before_or_equal'   =>  'Booking date should be within a month!',
            'start_time.required'    =>  'Start time is required!',
            'start_time.date_format'    =>  'Invalid start time format!',
            'end_time.required'  =>  'End time is required!',
            'end_time.date_format'  =>  'Invalid end time format!',
            'end_time.after'    =>  'End time should be after start time!'
        ];
        $validated  =   $request->validate([
            'venue_id'  =>  'required|exists:venues,id',
            'booking_date'  =>  'required|date_format:d-m-Y|after_or_equal:today|before_or_equal:'. now()->addMonth()->toDateString(),
            'start_time'    =>  'required|date_format:H:i',
            'end_time'  =>  'required|date_format:H:i|after:start_time'
        ],$message);

        $venue  =   Venue::find($request->venue_id);

        if($request->start_time < $venue->open_time || $request->end_time > $venue->close_time)
        {
            return response([
                'error'   =>  'invalid working hours!'
            ],400);
        }

        $overlapCheck   =   Booking::where('venue_id',$request->venue_id)
                            ->where('booking_date',$request->booking_date)
                            ->where(function($query) use ($request){

                                $query->where('start_time','<',$request->end_time)
                                    ->where('end_time','>',$request->start_time);

                            })->exists();
        // dd($overlapCheck);
        if($overlapCheck)
        {
            return response([
                'error'   =>  'Time slot already booked!'
            ],400);
        }
        // dd($request->user()->id);
        $validated['user_id']   =   $request->user()->id;
        $booking    =   Booking::create($validated);
        return response([
            'message'   =>  'Slot has been booked successfully!',
            'data'  =>  [
                'venue' =>  $venue->name,
                'booking_date'  =>  $booking->booking_date,
                'start_time'    =>  $booking->start_time,
                'end_time'  =>  $booking->end_time
            ]
        ],201);
    }
}
