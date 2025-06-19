<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@site.com',
            'password' => Hash::make('password123'), // كلمة المرور: password123
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Ali',
            'email' => 'ali@site.com',
            'password' => Hash::make('password123'),
            'role' => 'author',
        ]);

        User::create([
            'name' => 'Sara',
            'email' => 'sara@site.com',
            'password' => Hash::make('password123'),
            'role' => 'reader',
        ]);
    }
}
