<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user if it doesn't exist
        $adminEmail = 'admin@patitas.com';
        
        if (!User::where('email', $adminEmail)->exists()) {
            $adminUser = new User();
            $adminUser->setName('Administrator');
            $adminUser->setEmail($adminEmail);
            $adminUser->setPhone('+57 300 123 4567');
            $adminUser->setAddress('Medellín, Colombia');
            $adminUser->setPassword(Hash::make('admin123'));
            $adminUser->setRole(Role::Admin);
            $adminUser->save();
            
            $this->command->info('Admin user created successfully!');
            $this->command->info('Email: admin@patitas.com');
            $this->command->info('Password: admin123');
        } else {
            $this->command->info('Admin user already exists.');
        }
    }
}
