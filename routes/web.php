<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
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
    route::get('/services/{id}', [ServiceController::class , 'bookAService'])->name('book-service');
    route::post('reservation/{id}/cancel' , [ServiceController::class , 'cancelReservation'])->name('reservation.cancel');
    route::post('reservation/book' , [ServiceController::class , 'bookReservation'])->name('reservation.book');
    Route::patch('reservation/{id}/update' , [ServiceController::class , 'updateReservation'])->name('reservation.update');

    //dashboard routes
    Route::get('/dashboard', [DashboardController::class , 'dashboard'])->name('dashboard.index');
    Route::get('/dashboard/reservations/{id}/reschedule', [DashboardController::class , 'reschedule'])->name('dashboard.reschedule');
    Route::get('/dashboard/reservations/{id}/book-again', [DashboardController::class , 'bookAgain'])->name('dashboard.book-again');

    //logout
    Route::post('/logout' , [UserController::class , 'logout'])->name('logout');
});




                        //********************************ADMIN ROUTES*************************************
Route::prefix(('admin'))->group(function () {

    Route::get('/login', [AdminController::class, 'loginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'Adminlogin'])->name('adminLogin.form');

    Route::middleware(['auth:admin'])->group(function () {

        //pages
        Route::get('/dashboard', [AdminDashboardController::class , 'adminDashboard'])->name('admin.dashboard');
        Route::get('/reservations', [AdminDashboardController::class , 'reservation'])->name('admin.reservations');
        Route::get('/users', [AdminDashboardController::class , 'users'])->name('admin.users');
        Route::get('/services' , [AdminDashboardController::class , 'services'])->name('admin.services');


        //service
        Route::patch('admin/reservations/{id}/status', [AdminDashboardController::class, 'updateStatus'])->name('admin.reservations.status');
        Route::post('/service/{id}/change-availability', [AdminDashboardController::class, 'ChangeAvailability'])->name('admin.service.change-availability');


        //user
        Route::delete('/users/{id}', [AdminDashboardController::class, 'deleteUser'])->name('admin.user.delete');


        //logout
        Route::post('/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    });

});


