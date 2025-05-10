<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ScheduleController::class, 'index'])->name('home');
Route::inertia('/about', 'About')->name('about');

Route::middleware('auth')->group(function () {
    Route::middleware('verified')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/user-schedule', [DashboardController::class, 'userSchedule'])->name('user.schedule');
    });
    Route::resource('jadwal', ScheduleController::class)
        ->parameter('jadwal', 'schedule')
        ->except('index');
});

require __DIR__ . "/auth.php";
