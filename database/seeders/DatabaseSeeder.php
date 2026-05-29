<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@rab.com', // Anda bisa ganti email ini
            'password' => Hash::make('admin123'), // Passwordnya
        ]);
    }
}