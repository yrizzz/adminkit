<?php

use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Charts;
use App\Livewire\Dashboard;
use App\Livewire\DashboardView;
use App\Livewire\Forms;
use App\Livewire\GenericPage;
use App\Livewire\Icons;
use App\Livewire\Settings;
use App\Livewire\Tables;
use App\Livewire\UiElements;
use App\Livewire\Widgets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Guest (auth) — full-page Livewire components
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
    Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Authenticated application — full-page Livewire components
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/dashboards/{name}', DashboardView::class)->name('dashboard.show');

    Route::get('/ui/elements', UiElements::class)->name('ui.elements');
    Route::get('/ui/icons', Icons::class)->name('ui.icons');
    Route::get('/widgets', Widgets::class)->name('widgets');
    Route::get('/tables', Tables::class)->name('tables');
    Route::get('/charts', Charts::class)->name('charts');
    Route::get('/forms', Forms::class)->name('forms');
    Route::get('/settings', Settings::class)->name('settings');

    Route::get('/page/{path}', GenericPage::class)->name('page');
});
