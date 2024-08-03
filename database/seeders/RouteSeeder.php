<?php

namespace Database\Seeders;

use App\Models\Passenger;
use App\Models\Route;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Route::factory()
            ->count(18)
            ->has(Passenger::factory()->count(5))
            ->create();
    }
}
