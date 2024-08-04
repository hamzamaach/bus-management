<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRouteRequest;
use App\Http\Requests\UpdateRouteRequest;
use App\Models\Route;
use Carbon\Carbon;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Get the current time
        $now = Carbon::now();

        // Define the 3-hour window
        $start_time = $now->copy()->subHours(2);
        $end_time = $now->copy()->addHours(3);

        // Query routes within the 3-hour window
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

        // Return the view with filtered routes
        return view('index/main', compact('routes'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Route $route)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRouteRequest $request, Route $route)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        //
    }
}
