<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WheelController;

Route::get('/', function () {
    return redirect('/he');
});

Route::get('/{lang}', [WheelController::class, 'show'])
    ->whereIn('lang', ['ar', 'he'])
    ->name('wheel.show');