<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'super-admin',
            'description' => 'Administrator with full system access',
        ]);
        Role::create([
            'name' => 'admin',
            'description' => 'Administrator with full system access',
        ]);
        
        Role::create([
            'name' => 'moderator',
            'description' => 'Moderator with limited admin privileges',
        ]);

        Role::create([
            'name' => 'investor',
            'description' => 'User who can make investments',
        ]);

       
    }
}
