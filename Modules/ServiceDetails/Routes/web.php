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
Route::prefix('admin')->middleware(['auth:admin', 'set_lang'])->group(function () {
Route::prefix('servicedetails')->group(function() {
    Route::get('/', 'ServiceDetailsController@index')->name('module.service_p.index');;
    Route::get('/add', 'ServiceDetailsController@create')->name('module.service_p.create');
    Route::post('/add', 'ServiceDetailsController@store')->name('module.service_p.store');
    Route::get('/update/{id}', 'ServiceDetailsController@edit')->name('module.service_p.edit');
    Route::post('/update/{id}', 'ServiceDetailsController@update')->name('module.service_p.update');
});
});
