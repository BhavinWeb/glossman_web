<?php

use Illuminate\Support\Facades\Route;
use Modules\Packages\Http\Controllers\PackagesController;
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
    Route::prefix('packages')->group(function() {
        Route::get('/', [PackagesController::class, 'index'])->name('module.package.index');
        Route::get('/create', [PackagesController::class, 'create'])->name('module.package.create');
        Route::post('/create', [PackagesController::class, 'store'])->name('module.package.store');
        Route::get('/edit/{id}', [PackagesController::class, 'edit'])->name('module.package.edit');
        Route::post('/update/{id}', [PackagesController::class, 'update'])->name('module.package.update');
        Route::any('/destroy/{id}', [PackagesController::class, 'destroy'])->name('module.package.destroy');
        Route::get('/status/change', [PackagesController::class, 'status_change'])->name('module.package.status.change');
    });
});
