<?php

use Illuminate\Support\Facades\Route;
use Modules\Driver\Http\Controllers\DriverController;
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

Route::prefix('admin')->middleware(['auth:admin', 'set_lang'])->group(function () {
    Route::prefix('driver')->group(function () {
        Route::get('/module/driver', [DriverController::class, 'index'])->name('module.driver.index');
        Route::get('/create', [DriverController::class, 'create'])->name('module.driver.create');
        Route::post('/create', [DriverController::class, 'store'])->name('module.driver.store');
        Route::get('/edit/{id}', [DriverController::class, 'edit'])->name('module.driver.edit');
        Route::post('/update/{id}', [DriverController::class, 'update'])->name('module.driver.update');
        Route::any('/destroy/{id}', [DriverController::class, 'destroy'])->name('module.driver.destroy');
        Route::get('/status/change', [DriverController::class, 'status_change'])->name('module.driver.status.change');
    });
});