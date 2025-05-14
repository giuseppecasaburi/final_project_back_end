<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/movies", [UserController::class, "indexMovies"]);
Route::get("/movies/{id}", [UserController::class, "showMovie"]);

Route::get("/directors", [UserController::class, "indexDirectors"]);
Route::get("/directors/{id}", [UserController::class, "showDirector"]);

Route::get("/search", [SearchController::class, "apiSearch"]);