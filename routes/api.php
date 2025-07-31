<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\AdminController;

Route::get('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {

    // User Routes
    Route::get('/services', [ServiceController::class, 'index']);
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::get('/bookings', [BookingController::class, 'index']);

    // Admin Routes
    Route::middleware('admin')->group(function () {
        Route::post('/services', [AdminController::class, 'store']);
        Route::put('/services/{id}', [AdminController::class, 'update']);
        Route::delete('/services/{id}', [AdminController::class, 'destroy']);
        Route::get('/admin/bookings', [AdminController::class, 'bookings']);
    });
});
