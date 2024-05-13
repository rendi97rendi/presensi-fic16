<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('pages.dashboard', ['type_menu' => 'Beranda']);
    })->name('home');

    Route::resource('/users', UserController::class);
    Route::resource('/companies', CompanyController::class);
});

Route::get('/', function () {
    return view('pages.auth.auth-login');
});
