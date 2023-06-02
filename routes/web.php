<?php
use App\Http\Controllers\EmailController;

include(base_path('routes/auth.php'));
include(base_path('routes/payment.php'));
include(base_path('routes/command.php'));
include(base_path('routes/website.php'));
include(base_path('routes/admin.php'));

//Clear route cache
 Route::get('/route-cache', function() {
     Artisan::call('route:cache');
     return 'Routes cache cleared';
 });

 Route::get('/role-cache', function() {
     Artisan::call('cache:forget spatie.permission.cache');
     return 'Routes cache cleared';
 });

Route::get('/clear-route', function() {
    Artisan::call('route:clear');
    return 'Application route cache cleared';
});

 //Clear config cache
 Route::get('/config-cache', function() {
     Artisan::call('config:cache');
     return 'Config cache cleared';
 }); 

 // Clear application cache
 Route::get('/clear-cache', function() {
     Artisan::call('cache:clear');
     return 'Application cache cleared';
 });

 // Clear view cache
 Route::get('/view-clear', function() {
     Artisan::call('view:clear');
     return 'View cache cleared';
 });

 Route::get('/send-email', [EmailController::class, 'index']);
 Route::get('/map_data', [EmailController::class, 'sendNotification']);
