<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Generate the Master Admin Account
        User::create([
            'role' => 'admin',
            'first_name' => 'System',
            'last_name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@portal.edu',
            'password' => Hash::make('admin123'), // Secure default password
        ]);
    }
}