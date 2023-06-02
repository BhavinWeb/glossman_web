<?php
use Illuminate\Support\Facades\Route;
use Modules\Customer\Http\Controllers\CustomerController;

Route::prefix('admin')->name('module.')->middleware(['auth:admin', 'set_lang'])->group(function () {
    // Customer Routes
    Route::prefix('customer')->name('customer.')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::get('/add', [CustomerController::class, 'create'])->name('create');
        Route::post('/add', [CustomerController::class, 'store'])->name('store');
        Route::get('/show/{id}/details', [CustomerController::class, 'show'])->name('show');
        Route::get('/edit/{id:customer}', [CustomerController::class, 'edit'])->name('edit');
        Route::put('/update/{id:customer}', [CustomerController::class, 'update'])->name('updates');
        Route::delete('/destroy/{id:customer}', [CustomerController::class, 'destroy'])->name('destroy');
        Route::post('/get/states', [CustomerController::class, 'getStates'])->name('states');
        Route::post('/get/cities', [CustomerController::class, 'getCities'])->name('cities');
        Route::get('/status/change', [CustomerController::class, 'statusChange'])->name('status.change');
        Route::post('/update-note', [CustomerController::class, 'update_note'])->name('note.update_note');
        Route::post('/send-mail',[CustomerController::class,'send_mail']);
    });
});
