<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed default user
        User::factory()->create([
            'first_name' => 'Juan',
            'last_name' => 'Dela Cruz',
            'email' => 'juan@example.com',
            'password' => Hash::make('juan123'),
            'role' => 'buyer', // optional if 'buyer' is default
        ]);

        // Run category and product seeders in order
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}
