<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRouteRequest;
use App\Http\Requests\UpdateRouteRequest;
use App\Models\Route;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Check if the user is authenticated
        if (auth()->check()) {
            $routes = $this->getRoutesAsStaff();
        } else {
            // Get the current time
            $now = Carbon::now();

            // Define the 3-hour window
            $start_time = $now->copy()->subHours(1);
            $end_time = $now->copy()->addHours(5);

            // Query routes within the time window
            $routes = Route::whereBetween('time', [$start_time, $end_time])
                ->with([
                    'passengers' => function ($query) {
                        $query->whereDate('created_at', Carbon::today());
                    }
                ])->withCount([
                        'passengers' => function ($query) {
                            $query->whereDate('created_at', Carbon::today());
                        }
                    ])->get();

            // Calculate slots left and add index to passengers
            foreach ($routes as $route) {
                $route->slots_left = $route->slots - $route->passengers_count - $route->reserved;

                for ($i = 0; $i < $route->reserved; $i++) {
                    $newPassengers = collect([
                        (object) ['label' => 'staff', 'index' => $i + 1],
                    ]);

                    $route->passengers = $newPassengers->merge($route->passengers);
                }

                $index = $route->reserved;
                foreach ($route->passengers as $passenger) {
                    $passenger->index = $index++;
                }
            }
        }

        // Return the view with filtered routes
        return view('index', compact('routes'));
    }

    private function getRoutesAsStaff()
    {
        // Get the current time
        $now = Carbon::now();

        // Query routes within the time window
        $routes = Route::withCount([
            'passengers' => function ($query) {
                $query->whereDate('created_at', Carbon::today());
            }
        ])->get();

        // Calculate slots left and add index to passengers
        foreach ($routes as $route) {
            $route->slots_left = $route->slots - $route->passengers_count - $route->reserved;

            for ($i = 0; $i < $route->reserved; $i++) {
                $newPassengers = collect([
                    (object) ['label' => 'staff', 'index' => $i + 1],
                ]);

                $route->passengers = $newPassengers->merge($route->passengers);
            }

            $index = $route->reserved;
            foreach ($route->passengers as $passenger) {
                $passenger->index = $index++;
            }
        }

        return $routes;
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRouteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Route $route)
    {
        // Load the route with its passengers
        $route->load('passengers')->loadCount('passengers');
        $route->slots_left = $route->slots - $route->passengers_count - $route->reserved;


        // Return the view with the route and passengers
        return view('routes.show', compact('route'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Route $route)
    {
        return view('routes.edit', compact('route'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Route $route)
    {
        $validated = $request->validate([
            'start' => 'required|string|max:255',
            'end' => 'required|string|max:255',
            'time' => 'required|date_format:H:i',
            'status' => 'required|in:going,returning',
            'slots' => 'required|integer|min:1',
            'reserved' => 'required|integer|min:0',
        ]);

        $route->update($validated);

        return redirect()->route('routes.edit', $route)->with('status', 'route-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        // Delete the route
        $route->delete();

        // Redirect back to the routes list with a success message
        return redirect()->route('routes.index')->with('status', 'Route deleted successfully!');
    }
}
