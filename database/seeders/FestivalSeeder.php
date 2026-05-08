<?php

namespace Database\Seeders;

use App\Models\Festival;
use Illuminate\Database\Seeder;

class FestivalSeeder extends Seeder
{
    public function run(): void
    {
        $festivals = [
            ['name' => 'Pukkelpop', 'location' => 'Kiewit'],
            ['name' => 'Rock Werchter', 'location' => 'Werchter'],
            ['name' => 'Tomorrowland', 'location' => 'Boom'],
        ];

        foreach ($festivals as $festival) {
            Festival::firstOrCreate(['name' => $festival['name']], $festival);
        }
    }
}
