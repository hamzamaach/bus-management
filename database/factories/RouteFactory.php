<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Route>
 */
class RouteFactory extends Factory
{
    protected $routes = [
        ['Al Doha', 'Campus', '08:00'],
        ['Al Doha', 'Campus', '08:30'],
        ['Bab E.G', 'Campus', '08:30'],
        ['Bab E.G', 'Campus', '09:00'],
        ['Ben Idrar', 'Campus', '09:30'],
        ['Bab E.G', 'Campus', '10:00'],
        ['Bab E.G', 'Campus', '10:30'],
        ['Bab E.G', 'Campus', '11:00'],
        ['Bab E.G', 'Campus', '11:30'],
        ['Campus', 'Bab E.G', '17:30'],
        ['Campus', 'Bab E.G', '18:00'],
        ['Campus', 'Bab E.G', '18:30'],
        ['Campus', 'Ben Idrar', '19:00'],
        ['Campus', 'Bab E.G', '19:20'],
        ['Campus', 'Bab E.G', '19:30'],
        ['Campus', 'Bab E.G', '20:00'],
        ['Campus', 'Bab E.G', '20:30'],
        ['Campus', 'Bab E.G', '21:00'],
    ];

    protected $index = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        if ($this->index >= count($this->routes)) {
            $this->index = 0; // Reset index if we've gone through all routes
        }

        $route = $this->routes[$this->index];
        $this->index++;

        return [
            'start' => $route[0],
            'end' => $route[1],
            'time' => $route[2],
            'slots' => 20,
        ];
    }
}