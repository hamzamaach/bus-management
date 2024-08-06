<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePassengerRequest;
use App\Http\Requests\UpdatePassengerRequest;
use App\Models\AllowedPassengers;
use App\Models\Passenger;
use App\Models\Route;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PassengerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, Route $route)
    {
        $request->validate([
            'label' => 'required|string|max:25',
        ]);

        try {

            $label = $request->input('label');
            // Check if the label exists in the allowed_passengers table
            $labelExists = AllowedPassengers::where('label', $label)->exists();

            if (!$labelExists) {
                return response()->json(['error' => `'$label' doesn't exist !`], 404);
            }

            // Check if the passenger is already registered in another route with the same status and creation date
            $passengerExists = DB::table('routes')
                ->join('passengers', 'routes.id', '=', 'passengers.route_id')
                ->where('passengers.label', $label)
                ->where('routes.status', $route->status)
                ->whereDate('passengers.created_at', Carbon::today())
                ->exists();

            if ($passengerExists) {
                return response()->json(['error' => "'$label' already registered !"], 400);
            }

            // Create the passenger if the label is allowed and not already registered
            $passenger = $route->passengers()->create([
                'label' => $label,
            ]);

            return response()->json(['message' => 'Success', 'passenger' => $passenger], 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            \Log::error('Error creating passenger: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Passenger $passenger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Passenger $passenger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePassengerRequest $request, Passenger $passenger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Passenger $passenger)
    {
        //
    }
}
