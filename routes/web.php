<?php

use Illuminate\Support\Facades\Route;

Route::resource('/', App\Http\Controllers\WelcomeController::class);

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
   
    Route::resource('/users', App\Http\Controllers\UserController::class);
    Route::resource('/profile', App\Http\Controllers\ProfileController::class);
    Route::resource('/locations', App\Http\Controllers\LocationController::class);

    Route::resource('/tcls', App\Http\Controllers\TclController::class);
    Route::resource('/patients', App\Http\Controllers\PatientController::class);
    Route::resource('/staffs', App\Http\Controllers\StaffController::class);
    Route::resource('/appointments', App\Http\Controllers\AppointmentController::class);
});
require __DIR__.'/auth.php';
