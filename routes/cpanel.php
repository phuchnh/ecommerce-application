<?php


use App\Http\Controllers\Cpanel\Auth\LoginController;
use App\Http\Controllers\Cpanel\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('cp')->as('cpanel.')->group(function () {

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::middleware('auth:cpanel')->group(function () {
        Route::redirect('/', '/cp/dashboard');
        Route::get('dashboard', DashboardController::class)->name('dashboard');
    });
});
