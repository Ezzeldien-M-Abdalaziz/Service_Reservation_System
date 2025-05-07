<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\ServiceController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;


//home page public routes
Route::get('/', [HomeController::class , 'home'])->name('home');
Route::get('/login', [HomeController::class , 'login'])->name('login.form');
Route::get('/register', [HomeController::class , 'register'])->name('register.form');



//service public routes
route::get('/services', [ServiceController::class , 'services'])->name('services');



// User public Routes
    Route::post('/register' , [UserController::class , 'register'])->name('register');
    Route::post('/login' , [UserController::class , 'login'])->name('login');


//auth routes
Route::middleware('auth')->group(function () {

    //services
    route::get('/services/{id}', [ServiceController::class , 'serviceDetails'])->name('service.details');
    route::post('reservation/{id}/cancel' , [ServiceController::class , 'cancelReservation'])->name('reservation.cancel');

    //dashboard routes
    Route::get('/dashboard', [DashboardController::class , 'dashboard'])->name('dashboard.index');

    //logout
    Route::post('/logout' , [UserController::class , 'logout'])->name('logout');
});


