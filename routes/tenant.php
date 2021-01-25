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
        Route::get('/panel', [App\Http\Controllers\DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/member/create', [App\Http\Controllers\MemberController::class, 'create'])
            ->name('member.create')
            ->middleware('can:create_member');

        Route::post('/member', [App\Http\Controllers\MemberController::class, 'store'])
            ->name('member.store')
            ->middleware('can:create_member');

        Route::get('/members', [App\Http\Controllers\MemberController::class, 'index'])
            ->name('member.index')
            ->middleware('can:list_members');

        Route::get('/member/{id}/edit', [App\Http\Controllers\MemberController::class, 'edit'])
            ->name('member.edit');

        Route::delete('/member/{id}', [App\Http\Controllers\MemberController::class, 'destroy'])
            ->name('member.destroy');

        Route::put('/member/{id}', [App\Http\Controllers\MemberController::class, 'update'])
            ->name('member.update');

        Route::get('/reports', [App\Http\Controllers\ReportController::class, 'index'])
            ->name('report.index');
    });
});
