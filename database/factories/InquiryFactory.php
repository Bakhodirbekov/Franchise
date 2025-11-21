<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InquiryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'franchise_id' => \App\Models\Franchise::factory(),
            'user_id' => \App\Models\User::factory(),
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'message' => $this->faker->paragraphs(2, true),
            'status' => $this->faker->randomElement(['new', 'contacted', 'closed']),
            'admin_note' => $this->faker->optional()->paragraph,
        ];
    }

    public function new(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'new',
        ]);
    }

    public function contacted(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'contacted',
        ]);
    }

    public function closed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'closed',
        ]);
    }
}