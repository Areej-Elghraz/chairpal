<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organization>
 */
class OrganizationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'owner_id' => \App\Models\User::factory(),
            'country_id' => \App\Models\Country::factory(),
            'city_id' => \App\Models\City::factory(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'description' => fake()->paragraph(),
        ];
    }
}
