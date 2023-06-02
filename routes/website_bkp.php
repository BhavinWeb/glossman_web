<?php

use App\Http\Controllers\Admin\CampaignController;
use Illuminate\Support\Facades\Route;
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
        Route::get('/', 'index')->name('index');
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
