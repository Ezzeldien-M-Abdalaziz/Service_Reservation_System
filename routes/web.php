<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

                                        /***********ADMINS************/
Route::prefix('admin')->group(function () {
Route::post('/register' , [AdminController::class , 'register'])->name('register');
Route::post('/login' , [AdminController::class , 'login'])->name('login');

Route::middleware('auth:admin')->group(function () {
    Route::post('/logout' , [AdminController::class , 'logout'])->name('logout');



});

});

                                        /***********USERS************/
Route::prefix('/')->group(function () {
    Route::post('/register' , [UserController::class , 'register'])->name('register');
    Route::post('/login' , [UserController::class , 'login'])->name('login');

    Route::middleware('auth:user')->group(function () {
        Route::post('/logout' , [UserController::class , 'logout'])->name('logout');

    });
});

