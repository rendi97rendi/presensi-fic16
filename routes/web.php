<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Attendance;

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('pages.dashboard', ['type_menu' => 'Beranda']);
    })->name('home');

    Route::resource('/users', UserController::class);
    Route::resource('/companies', CompanyController::class);
    Route::resource('/attendances', AttendanceController::class);
});

Route::get('/', function () {
    return view('pages.auth.auth-login');
});
