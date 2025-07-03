<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('/chart/metrics', [ChartController::class, 'showMetricsChart']);
Route::get('/user/chart', [UserController::class, 'showChart']);
Route::post('/metrics', 'MetricsController@store')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
