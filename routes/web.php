<?php

use App\Http\Controllers\PassengerController;
use App\Http\Controllers\RouteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RouteController::class, 'index']);
Route::post('/routes/{route}/passengers', [PassengerController::class, 'store']);