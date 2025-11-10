<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $petTypes = ['Dog', 'Cat', 'Bird', 'Rabbit', 'Hamster'];
        $statuses = ['pending', 'confirmed', 'completed', 'cancelled'];

        return [
            'user_id'  => \App\Models\User::factory(),
            'date'     => fake()->dateTimeBetween('now', '+30 days')->format('Y-m-d'),
            'time'     => fake()->time('H:i'),
            'pet_name' => fake()->firstName(),
            'pet_type' => fake()->randomElement($petTypes),
            'reason'   => fake()->sentence(10),
            'status'   => fake()->randomElement($statuses),
        ];
    }
}
