<?php

use Illuminate\Support\Facades\Route;
use Modules\Service\Http\Controllers\ServiceController;

Route::prefix('admin')->middleware(['auth:admin', 'set_lang'])->group(function () {
    // Category Routes
    Route::prefix('service')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('module.service.index');
        Route::get('/add', [ServiceController::class, 'create'])->name('module.service.create');
        Route::post('/add', [ServiceController::class, 'store'])->name('module.service.store');
        Route::get('/edit/{service}', [ServiceController::class, 'edit'])->name('module.service.edit');
        Route::put('/update/{service}', [ServiceController::class, 'update'])->name('module.service.update');
        Route::get('/{service:slug}/show', [ServiceController::class, 'show'])->name('module.service.show');
        Route::any('/destroy/{service}', [ServiceController::class, 'destroy'])->name('module.service.destroy');
        Route::post('/service/update/order', [ServiceController::class, 'updateOrder'])->name('module.service.updateOrder');
        Route::get('/status/change', [ServiceController::class, 'status_change'])->name('module.service.status.change');
        
         Route::get('booking-list', [ServiceController::class, 'Booking_list'])->name('module.service.booking');
         Route::post('/booking/change', [ServiceController::class, 'booking_status_change'])->name('module.booking.status.change');
           Route::post('/booking/sp/change', [ServiceController::class, 'booking_spstatus_change'])->name('module.booking.spstatus.change');
           Route::get('/booking/show/{booking_id}', [ServiceController::class, 'booking_details'])->name('module.booking.show');
           
           Route::post('update-note', [ServiceController::class, 'update_note'])->name('module.booking.update_note');
           Route::get('/show-location/{booking_id}',[ServiceController::class, 'show_googlemap'])->name('module.booking.map');;
    
    	    Route::post('assign-driver', [ServiceController::class, 'AssignDriver'])->name('module.booking.assign_driver');

    });

});
Route::get('/get-sub-services/{category_id}', [ServiceController::class, 'getSubcategories']);
