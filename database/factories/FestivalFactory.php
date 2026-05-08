<?php

namespace Database\Factories;

use App\Models\Festival;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Festival>
 */
class FestivalFactory extends Factory
{
    public function definition(): array
    {
        $festivals = [
            ['name' => 'Tomorrowland', 'location' => 'Boom'],
            ['name' => 'Rock Werchter', 'location' => 'Werchter'],
            ['name' => 'Pukkelpop', 'location' => 'Hasselt'],
            ['name' => 'Graspop Metal Meeting', 'location' => 'Dessel'],
            ['name' => 'Couleur Café', 'location' => 'Brussel'],
            ['name' => 'Les Ardentes', 'location' => 'Luik'],
            ['name' => 'Dour Festival', 'location' => 'Dour'],
            ['name' => 'Lokerse Feesten', 'location' => 'Lokeren'],
        ];

        return [
            ...$this->faker->randomElement($festivals),
            'user_id' => User::factory(),
        ];
    }
}
