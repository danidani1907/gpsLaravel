<?php

use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

// Rota inicial redireciona para a lista de locations
Route::get('/', function () {
    return redirect()->route('locations.index');
});

// CRUD de Locations (web)
Route::resource('locations', LocationController::class);
