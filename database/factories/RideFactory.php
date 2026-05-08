<?php

namespace Database\Factories;

use App\Models\Festival;
use App\Models\Ride;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ride>
 */
class RideFactory extends Factory
{
    public function definition(): array
    {
        $cities = [
            'Antwerpen', 'Gent', 'Brugge', 'Leuven', 'Mechelen',
            'Hasselt', 'Kortrijk', 'Oostende', 'Aalst', 'Genk',
            'Roeselare', 'Sint-Niklaas', 'Turnhout', 'Brussel',
        ];

        $total = $this->faker->numberBetween(2, 6);

        return [
            'festival_id' => Festival::factory(),
            'user_id' => User::factory(),
            'driver_name' => $this->faker->name(),
            'departure_city' => $this->faker->randomElement($cities),
            'total_seats' => $total,
            'booked_seats' => $this->faker->numberBetween(0, $total),
            'departure_time' => $this->faker->dateTimeBetween('+1 week', '+3 months'),
            'description' => $this->faker->optional(0.7)->sentence(12),
        ];
    }
}
