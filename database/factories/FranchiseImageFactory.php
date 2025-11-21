<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FranchiseImageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'franchise_id' => \App\Models\Franchise::factory(),
            'path' => 'sample/franchise-' . $this->faker->numberBetween(1, 10) . '.jpg',
            'alt' => $this->faker->sentence(3),
            'order' => $this->faker->numberBetween(0, 5),
        ];
    }
}