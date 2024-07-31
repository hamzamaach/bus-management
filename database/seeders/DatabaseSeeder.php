<?php

namespace Database\Seeders;

use App\Models\Passenger;
use App\Models\Route;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        Route::factory()
            ->count(18)
            ->has(Passenger::factory()->count(5))
            ->create();
    }
}
