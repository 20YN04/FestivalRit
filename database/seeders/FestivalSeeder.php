<?php

namespace Database\Seeders;

use App\Models\Festival;
use App\Models\User;
use Illuminate\Database\Seeder;

class FestivalSeeder extends Seeder
{
    public function run(): void
    {
        $owner = User::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => bcrypt('password')]
        );

        $festivals = [
            ['name' => 'Pukkelpop', 'location' => 'Kiewit'],
            ['name' => 'Rock Werchter', 'location' => 'Werchter'],
            ['name' => 'Tomorrowland', 'location' => 'Boom'],
        ];

        foreach ($festivals as $festival) {
            Festival::firstOrCreate(
                ['name' => $festival['name']],
                [...$festival, 'user_id' => $owner->id]
            );
        }
    }
}
