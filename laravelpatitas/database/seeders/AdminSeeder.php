<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creates a default administrator user for the Patitas system.
     */
    public function run(): void
    {
        // Check if admin user already exists
        $existingAdmin = User::where('email', 'admin@patitas.com')->first();

        if (! $existingAdmin) {
            $admin = new User;
            $admin->setName('Administrator');
            $admin->setEmail('admin@patitas.com');
            $admin->setPhone('3001234567');
            $admin->setAddress('Patitas HQ - Admin Office');
            $admin->setPassword('admin123');
            $admin->setRole(Role::Admin);
            $admin->save();

            echo "✅ Administrator user created successfully!\n";
            echo "📧 Email: admin@patitas.com\n";
            echo "🔑 Password: admin123\n";
            echo "⚠️  Please change the password after first login\n";
        } else {
            echo "ℹ️  Administrator user already exists.\n";
        }
    }
}
