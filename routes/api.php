<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/movies", [UserController::class, "indexMovies"]);
Route::get("/movies/{id}", [UserController::class, "showMovie"]);

Route::get("/directors", [UserController::class, "indexDirectors"]);
Route::get("/select_directors", [UserController::class, "selectDirectors"]);
Route::get("/directors/{id}", [UserController::class, "showDirector"]);

Route::get("/genres", [UserController::class, "indexGenres"]);

Route::get("/search", [SearchController::class, "apiSearch"]);