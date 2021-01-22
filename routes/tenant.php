<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    'auth'
])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/panel', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    });
});
