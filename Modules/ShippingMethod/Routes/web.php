<?php

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

use Illuminate\Support\Facades\Route;
use Modules\ShippingMethod\Http\Controllers\PickupPointController;
use Modules\ShippingMethod\Http\Controllers\ShippingMethodController;

Route::middleware(['auth:admin', 'set_lang'])->group(function () {
    Route::prefix('admin/settings/shippingmethod')->group(function () {
        Route::get('/', [ShippingMethodController::class, 'index'])->name('module.shippingmethod.index');
        Route::get('/edit/{id}', [ShippingMethodController::class, 'edit'])->name('module.shippingmethod.edit');
        Route::put('/edit/{id}', [ShippingMethodController::class, 'update'])->name('module.shippingmethod.update');
    });

    Route::prefix('admin/settings/pickup-point')->group(function () {
        Route::get('/', [PickupPointController::class, 'index'])->name('module.pickup-point.index');
        Route::get('/create', [PickupPointController::class, 'create'])->name('module.pickup-point.create');
        Route::post('/create', [PickupPointController::class, 'store'])->name('module.pickup-point.store');
        Route::get('/edit/{id}', [PickupPointController::class, 'edit'])->name('module.pickup-point.edit');
        Route::put('/update/{id}', [PickupPointController::class, 'update'])->name('module.pickup-point.update');
        Route::delete('/destroy/{id}', [PickupPointController::class, 'destroy'])->name('module.pickup-point.destroy');
    });
});
