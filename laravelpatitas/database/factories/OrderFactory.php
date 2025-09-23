<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'         => \App\Models\User::factory(),
            'orderDate'       => $this->faker->dateTimeBetween('-1 year', 'now'),
            'status'          => $this->faker->randomElement(['pending', 'processing', 'shipped', 'delivered', 'cancelled']),
            'total'           => $this->faker->randomFloat(2, 50, 1000),
            'deliveryAddress' => $this->faker->address(),
        ];
    }
}
