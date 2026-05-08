<?php

namespace Database\Seeders;

use App\Models\Festival;
use App\Models\Ride;
use Illuminate\Database\Seeder;

class RideSeeder extends Seeder
{
    public function run(): void
    {
        $pkkp = Festival::where('name', 'Pukkelpop')->first();
        $rw = Festival::where('name', 'Rock Werchter')->first();
        $trow = Festival::where('name', 'Tomorrowland')->first();

        Ride::create([
            'festival_id' => $pkkp->id,
            'driver_name' => 'Dries',
            'departure_city' => 'Genk',
            'available_seats' => 3,
            'departure_time' => '2024-08-15 10:00:00',
            'description' => 'Gezellige rit, veel techno!',
        ]);

        Ride::create([
            'festival_id' => $rw->id,
            'driver_name' => 'Lotte',
            'departure_city' => 'Antwerpen',
            'available_seats' => 4,
            'departure_time' => '2024-07-04 09:30:00',
            'description' => 'Vertrek vanop park & ride Linkeroever, 20 EUR per persoon.',
        ]);

        Ride::create([
            'festival_id' => $trow->id,
            'driver_name' => 'Sam',
            'departure_city' => 'Leuven',
            'available_seats' => 2,
            'departure_time' => '2024-07-19 11:00:00',
            'description' => 'Heen-en-terug, terug zondagavond.',
        ]);

        Ride::create([
            'festival_id' => $trow->id,
            'driver_name' => 'Imke',
            'departure_city' => 'Gent',
            'available_seats' => 3,
            'departure_time' => '2024-07-26 08:00:00',
            'description' => null,
        ]);

        Festival::all()->each(function (Festival $festival) {
            Ride::factory()
                ->count(random_int(2, 4))
                ->for($festival)
                ->create();
        });
    }
}
