<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix(('admin'))->group(function () {

Route::post('/login', [AdminController::class, 'login']);
Route::post('/register', [AdminController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {

    //service crud
    Route::get('/services', [ServiceController::class, 'services']);
    Route::get('/services/{id}', [ServiceController::class, 'service']);
    Route::post('/service/store', [ServiceController::class, 'storeService']);
    Route::post('/services/update/{id}', [ServiceController::class, 'updateService']);
    Route::delete('/services/delete/{id}', [ServiceController::class, 'deleteService']);


    //reservations
    Route::get('/reservations', [ReservationController::class, 'reservations']);
    Route::get('/reservations/{id}', [ReservationController::class, 'reservation']);
    Route::post('/reservation/{id}/change-status', [ReservationController::class, 'changeStatus']);



    Route::post('/logout', [AdminController::class, 'logout']);
});

});
