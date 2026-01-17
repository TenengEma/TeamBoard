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
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@teamboard.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create regular users
        User::create([
            'name' => 'Patience Nkomo',
            'email' => 'patience@teamboard.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Faith Nduka',
            'email' => 'faith@teamboard.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
