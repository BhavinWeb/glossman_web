<?php

use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\DriverController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/currency/position/{amount}", function ($amount) {
    return multiCurrency($amount);
});

Route::get("/currency/position/shipping/{amount}", function ($amount) {
    session(['shipping_amount' => $amount]);
    return multiCurrency($amount);
});

Route::post('login', [LoginController::class, 'signin']);
Route::post('register', [LoginController::class, 'signup']);
Route::post('verification', [LoginController::class, 'otp_verification']);
Route::post('forgotpassword', [LoginController::class, 'forgotpassword']);
Route::get('config', [HomeController::class, 'Config']);
Route::get('check-user-detail',[LoginController::class,'check_user_details']);

Route::get('send_mail',[LoginController::class,'send_mail']);


// DRIVER API ROUTES
Route::post('driver-login', [DriverController::class, 'DirverLogin']);
Route::post('driver-email-verification', [DriverController::class, 'DriverEmailVerification']);
Route::post('driver-otp-verification', [DriverController::class, 'DriverOtpVerification']);
Route::post('driver-setpassword', [DriverController::class, 'DriverSetPassword']);
Route::post('update-fcm-token',[DriverController::class, 'UpdateFcmtoken']);
Route::get('share-driver-location',[DriverController::class, 'shareDriverLocation']);

Route::get('driver-home', [DriverController::class, 'DriverHomePage']);
Route::post('driver-service-status', [DriverController::class, 'DriverServiceStatus']);
Route::post('driver-tracking', [DriverController::class, 'DriverTracking']);


Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('logout',[LoginController::class,'logout']);
    Route::post('contact_us', [HomeController::class, 'Contact_us']);
    Route::post('delete_account', [LoginController::class, 'delete_account']);

    Route::get('homepage', [HomeController::class, 'homepage']);
    Route::get('package', [HomeController::class, 'packages']);
    Route::get('product_list', [HomeController::class, 'products_list']);
    Route::get('service-category-list', [ServiceController::class, 'service_category_list']);
    Route::get('get-service', [ServiceController::class, 'get_service']);
    Route::get('product-category-list', [ProductController::class, 'product_category_list']);
    Route::get('get-product-list', [ProductController::class, 'get_product_list']);
    // Route::get('get-product-details', [HomeController::class, 'get_product_details']);
    Route::get('product-details', [ProductController::class, 'product_details']);
    Route::post('change-password', [LoginController::class, 'change_password']);
    Route::get('get_user', [LoginController::class, 'get_user']);

    //profile_update

    Route::post('update-profile', [ProfileController::class, 'update_profile']);
    Route::get('get-pages', [HomeController::class, 'get_pages']);

    //favourite_product_action

    Route::post('favourite-action', [ProfileController::class, 'favourite_product_action']);

    Route::get('get-favourite-list', [ProfileController::class, 'get_favourite_product_list']);

    Route::post('review-rating', [ProfileController::class, 'review_rating']);

    Route::get('review-list', [ProfileController::class, 'get_reviews_ratings']);

    Route::post('add-to-cart', [ProfileController::class, 'add_to_cart']);

    Route::get('get-cart-list', [ProfileController::class, 'get_cart_list']);

    // Route::post('add-address')

    //packages 

    Route::post('package-buy',[PackageController::class, 'Package_buy']);

    Route::get('details_of_purchased_package',[PackageController::class,'Details_of_purchased_package']);

    //add service

    Route::post('add-service',[ServiceController::class, 'add_service']);

    Route::post('checkoutDataStore',[ProductController::class,'checkoutDataStore']);

    // promotion

    Route::get('promotions',[HomeController::class,'Promotions']);
    
    Route::get('faq',[HomeController::class,'FAQ']);

    Route::get('payment_card',[ProfileController::class,'card_action']);

    Route::get('order_list',[ProductController::class,'Order_list']);

    Route::get('order_details',[ProductController::class,'Order_details']);

    //notification 

    Route::get('get-notification',[ProfileController::class,'Get_Notification']);

    //order placing

    Route::post('orderPlacing',[ProductController::class,'orderPlacing']);

    Route::post('add-address',[ProductController::class,'Add_address']);

    Route::get('get-address',[ProductController::class,'get_address']);

    Route::post('apply-coupons',[ProductController::class,'apply_coupons']);
    
    Route::get('delete-coupon',[ProductController::class,'delete_coupon']);
    //checkout service
    
    Route::get('book-now',[ServiceController::class,'book_now']);
    
    Route::post('checkout-service',[ServiceController::class,'checkout_service']);
    
     Route::post('checkout-using-pay',[ServiceController::class,'checkout_using_pay']);

    Route::get('my-booking',[ServiceController::class,'my_booking']);

    Route::get('booking-details',[ServiceController::class,'booking_details']);

    Route::get('purchase-package-details',[ProfileController::class,'purchase_package_details']);
    
    Route::get('cancel-service',[ServiceController::class,'cancel_service']);
    
     Route::get('cancel-order',[ProductController::class,'cancel_order']);
     
     Route::get('search-product',[ProductController::class,'search_product']);
     
     Route::get('repeat-order',[ProductController::class,'repeat_order']);
     
     Route::get('notification-setting',[ProfileController::class,'Notification_setting']);
     Route::get('delete-account',[ProfileController::class,'DeleteAccount']);
     
     Route::get('order-success',[ProductController::class,'order_success'])->name('order_success');
     
     Route::get('booking-success',[ServiceController::class,'booking_success'])->name('booking_success');
     
     Route::post('payment',[ProductController::class,'payment'])->name('payment');
     
     Route::post('service-images',[ServiceController::class,'service_images']);
     
      
     
});

