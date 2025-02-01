<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $fillable = ['name', 'open_time', 'close_time'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
