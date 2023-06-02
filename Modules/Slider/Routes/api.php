<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Slider\Http\Controllers\SliderController;

Route::middleware('auth:api')->get('/slider', function (Request $request) {
    return $request->user();
});
