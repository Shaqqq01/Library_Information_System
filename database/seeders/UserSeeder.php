<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a supervisor user
        User::create([
            'name' => 'Supervisor Name',
            'email' => 'supervisor@example.com',
            'password' => Hash::make('password'), // Use a secure password in production
            'role' => 'supervisor',
        ]);

        // Create a volunteer user
        User::create([
            'name' => 'Volunteer Name',
            'email' => 'volunteer@example.com',
            'password' => Hash::make('password'), // Use a secure password in production
            'role' => 'volunteer',
        ]);
    }
}
