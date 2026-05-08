<?php

namespace App\Models;

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
        'available_seats',
        'departure_time',
        'description',
    ];

    protected $casts = [
        'departure_time' => 'datetime',
        'available_seats' => 'integer',
    ];

    public function festival(): BelongsTo
    {
        return $this->belongsTo(Festival::class);
    }
}
