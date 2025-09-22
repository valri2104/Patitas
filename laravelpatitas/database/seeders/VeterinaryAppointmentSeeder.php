<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VeterinaryAppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\VeterinaryAppointment::factory(20)->create();
    }
}
