<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Festival extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location'];

    public function rides(): HasMany
    {
        return $this->hasMany(Ride::class);
    }
}
