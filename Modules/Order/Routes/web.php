<?php

use Illuminate\Support\Facades\Route;
use Modules\Brand\Http\Controllers\BrandController;
use Modules\Order\Http\Controllers\OrderController;

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

Route::prefix('admin')->middleware(['auth:admin', 'set_lang'])->name('module.order.')->group(function () {
    // Brand Routes
    Route::prefix('order')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/{order:order_no}', [OrderController::class, 'show'])->name('show');
        Route::post('/status/change/{order:order_no}', [OrderController::class, 'statusChange'])->name('status.change');
        Route::get('/generate/pdf/{order}', [OrderController::class, 'generate'])->name('generate');
         Route::post('/update-note', [OrderController::class, 'update_note'])->name('order_update_note');
    });
});
