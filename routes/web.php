<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/geojson', [HomeController::class, 'getGeoJSON']);
Route::get('/gempa', function () {
    return view('gempa');
});
