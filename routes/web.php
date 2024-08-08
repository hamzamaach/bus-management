<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RouteController;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', [RouteController::class, 'index'])->name('home');
Route::post('/routes/{route}/passengers', [PassengerController::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'index'])
    // function () {
//     return view('dashboard');
// })
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/routes/{route}/edit', [RouteController::class, 'edit'])->name('routes.edit');
    Route::get('/routes/{route}', [RouteController::class, 'show'])->name('routes.show');
    Route::put('/routes/{route}', [RouteController::class, 'update'])->name('routes.update');
    Route::put('/routes/{route}', [RouteController::class, 'destroy'])->name('routes.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
