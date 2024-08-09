<?php

namespace Database\Seeders;

use App\Models\Passenger;
use App\Models\Route;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            AllowedPassengersSeeder::class,
            RouteSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'role' => 'staff',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}

// Route::factory()
//     ->count(18)
//     ->has(Passenger::factory()->count(5))
//     ->create();