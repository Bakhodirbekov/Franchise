<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FranchiseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->company . ' Franchise',
            'slug' => $this->faker->unique()->slug,
            'category_id' => \App\Models\Category::factory(),
            'short_description' => $this->faker->sentence(10),
            'description' => $this->faker->paragraphs(3, true),
            'investment_min' => $this->faker->numberBetween(20000, 50000),
            'investment_max' => $this->faker->numberBetween(50000, 200000),
            'royalty' => $this->faker->randomFloat(1, 3, 10),
            'territory' => $this->faker->randomElement(['National', 'Regional', 'State', 'City']),
            'requirements' => [
                'Business experience',
                'Liquid capital',
                'Management skills'
            ],
            'status' => $this->faker->randomElement(['published', 'draft']),
            'created_by' => \App\Models\User::factory(),
        ];
    }

    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'published',
        ]);
    }

    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'draft',
        ]);
    }
}