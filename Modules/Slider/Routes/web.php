<?php

use Illuminate\Support\Facades\Route;
use Modules\Slider\Http\Controllers\SliderController;

// Route::get('sliders/create', [SliderController::class, 'create'])->name('module.slider.create');
// Route::post('sliders', [SliderController::class, 'store'])->name('module.slider.store');
Route::middleware(['auth:admin', 'set_lang'])->prefix('admin')->group(function () {
    // slider Routes
    Route::prefix('slider')->group(function () {
        Route::get('/', [SliderController::class, 'index'])->name('module.slider.index');
        Route::get('/add', [SliderController::class, 'create'])->name('module.slider.create');
        Route::post('/add', [SliderController::class, 'store'])->name('module.slider.store');
        Route::get('/edit/{slider}', [SliderController::class, 'edit'])->name('module.slider.edit');
        Route::put('/update/{slider}', [SliderController::class, 'update'])->name('module.slider.update');
        Route::delete('/destroy/{slider}', [SliderController::class, 'destroy'])->name('module.slider.destroy');
        Route::delete('/multiple/destroy', [SliderController::class, 'multipleDestroy'])->name('module.slider.multiple.destroy');
        Route::post('/sorting', [SliderController::class, 'sliderSort'])->name('module.slider.sort');
    });
});
