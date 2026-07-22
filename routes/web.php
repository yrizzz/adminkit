<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Guest (auth) routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/forgot-password', [AuthController::class, 'showForgot'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendReset'])->name('password.email');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Authenticated application
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboards/{name}', [DashboardController::class, 'show'])->name('dashboard.show');

    Route::get('/ui/elements', [PageController::class, 'uiElements'])->name('ui.elements');
    Route::get('/ui/icons', [PageController::class, 'icons'])->name('ui.icons');
    Route::get('/widgets', [PageController::class, 'widgets'])->name('widgets');
    Route::get('/tables', [PageController::class, 'tables'])->name('tables');
    Route::get('/charts', [PageController::class, 'charts'])->name('charts');
    Route::get('/forms', [PageController::class, 'forms'])->name('forms');
    Route::get('/settings', [PageController::class, 'settings'])->name('settings');

    // Generic scaffold page for every other menu leaf (keeps all nav clickable).
    Route::get('/page/{path}', [PageController::class, 'generic'])->name('page');
});
