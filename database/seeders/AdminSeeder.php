<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user for testing purposes only.
        User::factory()->create([
            'name' => 'Admin Admin',
            'email' => 'admin@gmail.com',
            'password'=> Hash::make(12345678),
            'admin' => true
        ]);
    }
}
