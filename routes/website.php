<?php

use App\Http\Controllers\Admin\CampaignController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontend\SubscribeController;
use App\Http\Controllers\Api\LoginController;
use App\Models\Setting;


Route::controller(AuthController::class)->group(function () {
   // Route::get('/login', function () {
     Route::get('signin', [AuthController::class, 'signin'])->name('signin');
    //});
    // Route::get('/', 'index')->name('index');
    
});
Route::GET('get-state',[HomeController::class,'get_state'])->name('get_state');
Route::GET('get-city',[HomeController::class,'get_city'])->name('get_city');
Route::POST('search-bar',[HomeController::class,'search_data'])->name('search_data');
Route::GET('cart-count',[ProfileController::class,'cart_count'])->name('cart_count');

Route::POST('cancel-order',[ProductController::class,'cancelOrder'])->name('cancel_order');

Route::GET('product-track',[ProductController::class,'product_track'])->name('product_track');

Route::get('delete_cart',[ProductController::class,'delete_cart'])->name('delete_cart');

Route::get('track-orders',[HomeController::class,'track_order'])->name('track_order');

Route::get('payment',function(){
	return view('frontend.payment');
});


Route::get('email_otp',[AuthController::class,'email_otp'])->name('email_otp');

Route::get('get-nav-cart',[ProfileController::class,'get_cart_nav'])->name('get_nav_cart');

Route::POST('package-buy',[ProfileController::class,'buy_package'])->name('package_buy');

Route::get('add-nav-cart',[ProfileController::class,'add_nav_cart'])->name('add_nav_cart');
Route::get('payment-checkout',[HomeController::class,'payment_checkout']);

Route::get('login', [AuthController::class, 'signin'])->name('login');

Route::get('/', [HomeController::class, 'index'])->name('web.home');

Route::get('faq-list',[HomeController::class, 'faq_list'])->name('faq_list');

Route::get('/applay-coupon',[ProductController::class,'applay_coupon'])->name('applay_coupon');

Route::get('/addservice',[ServiceController::class,'addservice'])->name('addservice');

Route::get('/check-user-details',[AuthController::class,'check_user_details'])->name('check_user_details');

Route::get('/review_action',[ProductController::class,'Review_action'])->name('review_action');

Route::get('/remove_coupon',[ProductController::class,'remove_coupon'])->name('remove_coupon');

Route::group(['middleware' => 'auth'], function () {
  	
  	Route::get('repeat-order',[ProductController::class,'repeat_order'])->name('repeat_order');

	Route::get('booking_cancel',[ServiceController::class,'booking_cancel'])->name('booking_cancel');

	Route::post('place-order',[ProductController::class,'place_order'])->name('place_order');

	Route::POST('add-review',[ProductController::class,'addreview'])->name('addreview');

	Route::get('carservice', [HomeController::class, 'serviceIndex'])->name('carservice');
    	Route::get('productcategory', [HomeController::class, 'productIndex'])->name('productcategory');
    	Route::get('promotion', [HomeController::class, 'couponIndex'])->name('promotion');
	Route::get('wishlist', [WishlistController::class, 'index']);
	Route::get('logout', [AuthController::class, 'logout'])->name('logout');
	//profile

	Route::get('user-profile',[ProfileController::class,'profile'])->name('user_profile');
	Route::post('update-profile',[ProfileController::class,'update_profile'])->name('update_profile');

	//favourite list

	Route::get('favourite-list',[ProfileController::class,'favourite_list'])->name('favourite_list');
	Route::get('favourite-action',[ProfileController::class,'favourite_action'])->name('favourite_action');

	//faq
	Route::get('faq-list',[HomeController::class, 'faq_list'])->name('faq_list');

	//setting 
	Route::get('user-setting',[ProfileController::class, 'setting'])->name('user_setting');
	Route::get('change_password',[ProfileController::class, 'Change_password'])->name('change_password');
	Route::post('change_password',[ProfileController::class, 'Update_password'])->name('change_password');
	
	//product 
	
	Route::get('product-list/{category_id}',[ProductController::class,'index'])->name('product_list');

	Route::get('get-product-data',[ProductController::class,'get_product_data'])->name('get_product_name');
	
	Route::get('product-detail/{id}',[ProductController::class,'Product_details'])->name('product_details');
	
	Route::get('help-action',[ProductController::class,'helpAction'])->name('help_action');
	
	
	
	Route::post('AddtoCart',[ProfileController::class,'AddtoCart'])->name('AddtoCart');
	
	Route::get('shopping-cart',[ProductController::class,'Shopping_cart'])->name('shopping_cart');
	
	Route::get('user-checkout',[ProductController::class,'Checkout'])->name('checkouts');
	
	Route::get('order-confirmation/{order_id}',[ProductController::class,'Confirmation'])->name('order_confirmation');
	
	Route::get('order-list',[ProductController::class,'My_order'])->name('order_list');
	
	Route::get('get-shipping-rate',[ProductController::class,'get_shipping_rate'])->name('get_shipping_rate');
	
	Route::get('order-details/{order_id}',[ProductController::class,'Order_detail'])->name('orderdetails');
	
	//service 

	Route::get('service-details/{service_id}',[ServiceController::class,'service_details'])->name('service_details');
	Route::get('schedule-booking',[ServiceController::class,'schedule_booking'])->name('schedule_booking');
	Route::POST('service-payment',[ServiceController::class,'service_book'])->name('service_book');
	Route::post('checkout-service',[ServiceController::class,'checkout_service'])->name('checkout_service');
	Route::post('payment-checkout-service',[ServiceController::class,'payment_checkout_service'])->name('payment_checkout_service');
	Route::get('booking-list',[ServiceController::class,'my_booking'])->name('my_booking');
	Route::get('booking-detail/{id}',[ServiceController::class,'booking_detail'])->name('booking_detail');
	Route::get('track-sp/{id}',[ServiceController::class,'track_sp'])->name('track_sp');
	
	Route::post('after_image_upload',[ServiceController::class,'after_image_upload'])->name('after_image_upload');
	
	
	
	//package 
	
	Route::get('Package-visit',[ProfileController::class,'package_visit'])->name('Package_visit');
	
	Route::get('delete-account',[ProfileController::class,'delete_account'])->name('delete_account');
	
	
});

Route::get('contact-us',[ProfileController::class,'Contact_us'])->name('contact_us');
Route::post('Store-contact-us',[ProfileController::class,'Store_contact_us'])->name('Store_contact_us');
Route::post('store-subscriber', [SubscribeController::class, 'store_subscriber'])->name('store_subscriber');

Route::get('signin', [AuthController::class, 'signin'])->name('signin');
Route::get('signup', [AuthController::class, 'signup'])->name('signup');

Route::post('user-signup', [AuthController::class, 'user_signup'])->name('user_signup');
Route::post('signin', [AuthController::class, 'user_login'])->name('user_login');

Route::get('user-verification',[AuthController::class,'user_verification'])->name('user-verification');
Route::post('user-verification-otp',[AuthController::class,'user_verification_otp'])->name('user_verification_otp');
Route::get('resend-otp',[AuthController::class,'resend_otp'])->name('resend-otp');

Route::post('forgotpassword', [AuthController::class, 'forgotpassword'])->name('forgotpassword');

//forgot password 
Route::get('forgot-password',[AuthController::class,'forgot_password'])->name('forgot_password');





Route::get('terms-condition', function () {
$data = Setting::first();
    return view('frontend.term',['data'=>$data->terms_condition]);
 })->name('terms_condition');
 
 Route::get('about-us', function () {
 $data = Setting::first();
    return view('frontend.aboutus',['about'=>$data->about_us]);
 })->name('about_us');
 
 Route::get('privacy',function (){
 $data = Setting::first();
 	return view('frontend.policy',['data'=>$data->privacy_policy]);
 })->name('policy');
 


use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\DashboardController;

Route::name('website.')->group(function () {

    Route::controller(DashboardController::class)->middleware('auth')->prefix('customer')->name('customer.')->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/order/history', 'orderHistory')->name('order.history');
        Route::post('/download/order/{order}', 'orderDownload')->name('order.download');
        Route::get('/order/details', 'orderDetails')->name('order.detail');
        Route::post('/order/product/rating', 'productReview')->name('order.product.rating');
        Route::post('/get/order/product/rating', 'getProductReview')->name('get.order.product.rating');
        Route::get('/addresses', 'address')->name('address');
        Route::get('/setting', 'setting')->name('setting');
        Route::put('/setting/update', 'settingUpdate')->name('setting.update');
        Route::put('/password/update', 'passwordUpdate')->name('password.update');
        Route::post('/billing/address/update', 'billingAddressUpdate')->name('billing.address.update');
        Route::post('/shipping/address/update', 'shippingAddressUpdate')->name('shipping.address.update');
        Route::get('/browsing/history', 'browsingHistory')->name('browse.history');
        Route::post('/toggle/favorite/{product}', 'toggleFavorite')->name('toggle.favorite');
        Route::get('/wishlist', 'wishlist')->name('wishlist');
        Route::post('/get/states', 'getStates')->name('states')->withoutMiddleware('auth');
        Route::post('/get/cities', 'getCities')->name('cities')->withoutMiddleware('auth');
        Route::post('/remove/from/browse/history/{product}', 'removeFromHistory')->name('remove.from.history');
        Route::post('/save/browse/history', 'saveBrowseHistory')->name('save.browse.history');
    });

    Route::controller(CartController::class)->group(function () {
        Route::post('/add/cart', 'addToCart')->name('cart.add');
        Route::post('/update/cart/quantity', 'updateCart')->name('cart.update.quantity');
        Route::post('/update/single-cart/quantity', 'updateSingleCart')->name('single.cart.quantity.update');
        Route::get('/remove/cart/{cart_id}', 'removeFromCart')->name('cart.remove');
        Route::post('/remove/cart/ajax', 'removeFromCartAjax')->name('cart.remove.ajax');
        Route::get('/count/cart', 'countCart')->name('cart.count');
        Route::get('/fetch/cart', 'fetchCartItems')->name('cart.item');
        Route::get('/fetch/cart/subtotal', 'fetchCartSubtotal')->name('cart.subtotal');
        Route::get('/buy/now/{product}', 'buyNow')->name('buy.now');
        Route::get('/cart', 'cart')->name('cart');
        Route::post('/coupon/apply', 'couponApply')->name('coupon.apply');
        Route::post('/coupon/clear', 'couponClear')->name('coupon.clear');
    });


    Route::controller(FrontendController::class)->group(function () {
       // Route::get('/', 'index')->name('index');
        Route::get('/about', 'about')->name('about');
        Route::get('/privacy-policy', 'privacy')->name('privacy');
        Route::get('/terms-conditions', 'terms')->name('terms');
        Route::get('/refund-policy', 'refund')->name('refund');
        Route::get('/faq', 'faq')->name('faq');
        Route::get('/support', 'support')->name('support');
        Route::get('/track-order', 'trackOrder')->name('track.order');
        Route::get('/track-order/details', 'orderDetails')->name('track.order.detail');
        Route::get('/posts', 'posts')->name('post');
        Route::get('/posts/{post:slug}', 'postDetails')->name('post.details');
        Route::post('/posts/{postid}/comment/add', 'postComment')->name('post.comment.add');
        Route::post('/posts/{postid}/reply/add', 'postCommentReply')->name('post.reply.add');
        Route::get('/checkout', 'checkout')->name('checkout');
        Route::post('/checkout', 'checkoutDataStore')->name('checkout.store');
        Route::get('/checkout/success', 'checkoutSuccess')->name('checkout.success');
        Route::get('/compare', 'compare')->name('compare');
        Route::post('/add/to/compare/{product}', 'addToCompare')->name('add.compare');
        Route::get('/shop', 'products')->name('product');
        Route::get('/shop/{product:slug}', 'productDetails')->name('product.detail');
        Route::get('/products/quick/{product:slug}', 'quickProductDetail')->name('quick.product.details');
        Route::post('/default/currency', 'defaultCurrency')->name('currency.default');
        Route::get('/product/attributes/{product}', 'productAttributes')->name('product.attribute');
    });

    Route::controller(CampaignController::class)->name('campaign.')->group(function () {
        Route::get('/campaigns', 'campaignList')->name('list');
        Route::get('/campaign/{campaign:slug}', 'campaignDetails')->name('details');
    });
});

Route::get('/dashboard', [FrontendController::class, 'dashboard'])->name('home')->middleware(['auth:user', 'verified']);
