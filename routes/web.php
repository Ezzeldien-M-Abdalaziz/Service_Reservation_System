<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\ServiceController;
use App\Http\Controllers\User\UserController;
use App\Models\Service;
use Illuminate\Support\Facades\Route;


//home page routes
Route::get('/', [HomeController::class , 'home'])->name('home');
Route::get('/login', [HomeController::class , 'login'])->name('login');
Route::get('/register', [HomeController::class , 'register'])->name('register');
route::get('/services', [ServiceController::class , 'services'])->name('services');
route::get('/services/{id}', [ServiceController::class , 'serviceDetails'])->name('service.details');





     // User Routes
    Route::post('/register' , [UserController::class , 'register'])->name('register');
    Route::post('/login' , [UserController::class , 'login'])->name('login');

    Route::middleware('auth:user')->group(function () {
        Route::post('/logout' , [UserController::class , 'logout'])->name('logout');

    });
