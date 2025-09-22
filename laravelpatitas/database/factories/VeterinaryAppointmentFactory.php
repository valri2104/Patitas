<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VeterinaryAppointment>
 */
class VeterinaryAppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date_time'    => $this->faker->dateTimeBetween('now', '+1 month'),
            'service_type' => $this->faker->randomElement([
                'consulta',
                'vacunacion',
                'cirugia',
                'emergencia',
            ]),
            'status'  => $this->faker->randomElement(['programada', 'confirmada', 'completada', 'cancelada']),
            'notes'   => $this->faker->optional()->paragraph(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
