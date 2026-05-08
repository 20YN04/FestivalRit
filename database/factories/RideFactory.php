<?php

namespace Database\Factories;

use App\Models\Festival;
use App\Models\Ride;
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

        return [
            'festival_id' => Festival::factory(),
            'driver_name' => $this->faker->name(),
            'departure_city' => $this->faker->randomElement($cities),
            'available_seats' => $this->faker->numberBetween(1, 6),
            'departure_time' => $this->faker->dateTimeBetween('+1 week', '+3 months'),
            'description' => $this->faker->optional(0.7)->sentence(12),
        ];
    }
}
