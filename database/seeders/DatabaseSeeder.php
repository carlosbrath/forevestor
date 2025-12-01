<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles first
        $this->call(RoleSeeder::class);

        // Create admin users
        User::create([
            'full_name' => 'Super Admin',
            'email' => 'superadmin@forevestor.com',
            'phone' => '+1234567890',
            'password' => bcrypt('.com2025'),
            'role_id' => 1, // super-admin
            'status' => 'active',
            'terms_agreed' => true,
            'email_verified_at' => now(),
        ]);

        User::create([
            'full_name' => 'Admin',
            'email' => 'admin@forevestor.com',
            'phone' => '+1234567891',
            'password' => bcrypt('.com2025'),
            'role_id' => 2, // admin
            'status' => 'active',
            'terms_agreed' => true,
            'email_verified_at' => now(),
        ]);

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
