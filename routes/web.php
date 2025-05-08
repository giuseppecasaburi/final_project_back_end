<?php

use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, "index"])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource("/movies", MovieController::class)->middleware(['auth', 'verified']);

Route::resource("/genre", GenreController::class)->middleware(['auth', 'verified']);

Route::resource("/directors", DirectorController::class)->middleware(['auth', 'verified']);

Route::get("/search", [SearchController::class, "index"])->name("search");

require __DIR__.'/auth.php';