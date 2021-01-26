<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('app');

Route::middleware([
    'web',
    'auth'
])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/panel', [App\Http\Controllers\DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/user/create', [App\Http\Controllers\UserController::class, 'create'])
            ->name('user.create')
            ->middleware('can:create_user');

        Route::post('/user', [App\Http\Controllers\UserController::class, 'store'])
            ->name('user.store')
            ->middleware('can:create_user');

        Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])
            ->name('user.index')
            ->middleware('can:list_users');

        Route::get('/user/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])
            ->name('user.edit');

        Route::delete('/user/{id}', [App\Http\Controllers\UserController::class, 'destroy'])
            ->name('user.destroy');

        Route::put('/user/{id}', [App\Http\Controllers\UserController::class, 'update'])
            ->name('user.update');

        Route::get('/reports', [App\Http\Controllers\ReportController::class, 'index'])
            ->name('report.index');
    });
});
