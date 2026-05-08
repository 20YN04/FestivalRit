<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ride extends Model
{
    use HasFactory;

    protected $fillable = [
        'festival_id',
        'driver_name',
        'departure_city',
        'total_seats',
        'booked_seats',
        'departure_time',
        'description',
    ];

    protected $casts = [
        'departure_time' => 'datetime',
        'total_seats' => 'integer',
        'booked_seats' => 'integer',
    ];

    public function festival(): BelongsTo
    {
        return $this->belongsTo(Festival::class);
    }

    protected function seatsAvailable(): Attribute
    {
        return Attribute::get(fn () => max(0, $this->total_seats - $this->booked_seats));
    }

    protected function isFull(): Attribute
    {
        return Attribute::get(fn () => $this->seats_available <= 0);
    }
}
