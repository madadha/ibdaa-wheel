<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WheelController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminWheelItemController;
use App\Http\Middleware\AdminAuth;

Route::get('/', function () {
    return redirect('/he');
});

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [AdminAuthController::class, 'login'])
        ->name('login.submit');

    Route::post('/logout', [AdminAuthController::class, 'logout'])
        ->name('logout');

    Route::middleware(AdminAuth::class)->group(function () {

        Route::get('/', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('categories', AdminCategoryController::class)
            ->except(['show']);

        Route::resource('wheel-items', AdminWheelItemController::class)
            ->except(['show']);
    });
});

Route::get('/{lang}', [WheelController::class, 'show'])
    ->whereIn('lang', ['ar', 'he'])
    ->name('wheel.show');