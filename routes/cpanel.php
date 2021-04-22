<?php


use App\Http\Controllers\Cpanel\Auth\LoginController;
use App\Http\Controllers\Cpanel\DashboardController;
use App\Http\Controllers\Cpanel\SettingController;
use App\Http\Controllers\Cpanel\MediaController;
use App\Http\Controllers\Cpanel\PromotionController;
use Illuminate\Support\Facades\Route;

Route::prefix('cp')->as('cpanel.')->group(function () {

    Route::get('/login', [LoginController::class, 'create'])
        ->middleware('guest')
        ->name('login');

    Route::post('/login', [LoginController::class, 'store'])
        ->middleware('guest');

    Route::post('/logout', [LoginController::class, 'destroy'])
        ->name('logout');

    Route::middleware('auth:cpanel')->group(function () {
        Route::redirect('/', '/cp/dashboard');

        Route::get('/dashboard', DashboardController::class)
            ->name('dashboard');

        Route::get('/setting', [SettingController::class, 'create'])
            ->name('setting');

        Route::put('/setting', [SettingController::class, 'update']);

        Route::get('/media', [MediaController::class, 'index'])
            ->name('media.index');

        Route::post('/media/upload', [MediaController::class, 'upload'])
            ->name('media.upload');

        Route::delete('/media/{media}', [MediaController::class, 'destroy'])
            ->name('media.destroy');

        Route::resource('promotions', PromotionController::class);
    });
});
