<?php

use Illuminate\Support\Facades\Route;

Route::resource('/', App\Http\Controllers\WelcomeController::class);

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/search', [App\Http\Controllers\WelcomeController::class, 'search']);
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/tcls/{id}', [App\Http\Controllers\DashboardController::class, 'tcls']);
    Route::get('/print/{id}', [App\Http\Controllers\DashboardController::class, 'print']);

    Route::resource('/users', App\Http\Controllers\UserController::class);
    Route::resource('/profile', App\Http\Controllers\ProfileController::class);
    Route::resource('/locations', App\Http\Controllers\LocationController::class);

    Route::resource('/tcls', App\Http\Controllers\TclController::class);
    Route::resource('/immunizations', App\Http\Controllers\ImmunizationController::class);

    Route::resource('/families', App\Http\Controllers\FamilyController::class);
    Route::resource('/patients', App\Http\Controllers\PatientController::class);
    Route::get('/members', [App\Http\Controllers\MemberController::class, 'members']);
    Route::resource('/staffs', App\Http\Controllers\StaffController::class);
    Route::resource('/appointments', App\Http\Controllers\AppointmentController::class);

    Route::post('/dropout', [App\Http\Controllers\AppointmentController::class, 'dropout']);
    Route::post('/schedule', [App\Http\Controllers\AppointmentController::class, 'schedule']);
    Route::post('/visit', [App\Http\Controllers\AppointmentController::class, 'visit']);
    Route::post('/status', [App\Http\Controllers\AppointmentController::class, 'status']);
    Route::post('/delivery', [App\Http\Controllers\AppointmentController::class, 'delivery']);
    Route::post('/checkup', [App\Http\Controllers\AppointmentController::class, 'checkup']);
    Route::post('/checkupf', [App\Http\Controllers\AppointmentController::class, 'checkupf']);

    Route::get('/insights', [App\Http\Controllers\InsightController::class, 'index']);
});
require __DIR__.'/auth.php';
