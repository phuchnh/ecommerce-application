<?php


use App\Http\Controllers\Cpanel\Auth\LoginController;
use App\Http\Controllers\Cpanel\DashboardController;
use App\Http\Controllers\Cpanel\SettingController;
use App\Http\Controllers\Cpanel\PromotionController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->as('cpanel.')->group(function () {

    Route::get('/login', [LoginController::class, 'create'])
        ->middleware('guest')
        ->name('login');

    Route::post('/login', [LoginController::class, 'store'])
        ->middleware('guest');

    Route::post('/logout', [LoginController::class, 'destroy'])
        ->name('logout');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::redirect('/', '/admin/dashboard');

        Route::get('/dashboard', DashboardController::class)
            ->name('dashboard');

        Route::get('/setting', [SettingController::class, 'create'])
            ->name('setting');

        Route::put('/setting', [SettingController::class, 'update']);

        // Promotions
        Route::put('promotions/{promotion}/publish', [PromotionController::class, 'publish'])
            ->name('promotions.publish');

        Route::resource('promotions', PromotionController::class);
    });
});
