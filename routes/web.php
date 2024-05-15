<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Attendance;
use App\Models\Permission;

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('pages.dashboard', ['type_menu' => 'Beranda']);
    })->name('home');
    Route::get('/document/{fileName}/{folder}', [DocumentController::class, 'images'])->name('open.api.image');

    Route::resource('/users', UserController::class);
    Route::resource('/companies', CompanyController::class);
    Route::resource('/attendances', AttendanceController::class);
    Route::resource('/permissions', PermissionController::class);
});

Route::get('/', function () {
    return view('pages.auth.auth-login');
});
