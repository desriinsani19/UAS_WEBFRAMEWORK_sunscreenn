<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@sunadmin.com',
            'password' => Hash::make('password123'),
            'role' => 'admin'
        ]);

        // Create Admin User
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@desriinsani.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin'
        ]);

        // Create Regular User
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user'
        ]);

        $this->command->info('Admin user created successfully!');
        $this->command->info('Email: admin@sunadmin.com');
        $this->command->info('Password: password123');
        
        
    }
}