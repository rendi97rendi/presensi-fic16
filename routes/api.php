<?php

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\NoteController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\Cors;
use App\Http\Middleware\ForceJsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group([
    'middleware' => [ForceJsonResponse::class, Cors::class],
    'controller' => AuthController::class
], function () {
    Route::post('/login', 'login')->name('login.api');
    Route::post('/register', 'register')->name('register.api');
});

Route::middleware([ForceJsonResponse::class, Cors::class, 'auth:sanctum'])->group(function () {

    Route::controller(AuthController::class)->group(function () {
        // our routes to be protected will go in here
        Route::post('/logout', 'logout')->name('logout.api');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/pengguna', 'index')->name('pengguna.api');
        Route::post('/pengguna', 'store')->name('pengguna.store.api');
        Route::patch('/pengguna', 'update')->name('pengguna.update.api');
        Route::delete('/pengguna', 'destroy')->name('pengguna.destroy.api');
        Route::post('/pengguna/profile/update', 'updateProfile')->name('pengguna.profile.update.api');
    });
    Route::controller(CompanyController::class)->group(function () {
        Route::get('/perusahaan', 'index')->name('perusahaan.api');
        Route::get('/perusahaan/show/{id}', 'show')->name('perusahaan.show.api');
        Route::post('/perusahaan', 'store')->name('perusahaan.store.api');
        Route::patch('/perusahaan', 'update')->name('perusahaan.update.api');
        Route::delete('/perusahaan', 'destroy')->name('perusahaan.destroy.api');
    });
    Route::controller(AttendanceController::class)->group(function () {
        Route::get('/kehadiran', 'index')->name('kehadiran.api');
        Route::post('/kehadiran/check-in', 'checkIn')->name('kehadiran.checkIn.api');
        Route::post('/kehadiran/check-out', 'checkOut')->name('kehadiran.checkOut.api');
        Route::get('/kehadiran/is-checkin', 'isCheckIn')->name('kehadiran.isCheckIn.api');
    });

    Route::apiResource('izin', PermissionController::class);

    Route::apiResource('catatan', NoteController::class);
});
