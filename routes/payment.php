<?php

use Modules\Order\Entities\Order;
use Illuminate\Support\Facades\Route;
use App\Services\Midtrans\CreateSnapTokenService;
use App\Http\Controllers\Payment\MollieController;
use App\Http\Controllers\Payment\PayPalController;
use App\Http\Controllers\Payment\StripeController;
use App\Http\Controllers\Payment\PaystackController;
use App\Http\Controllers\Payment\RazorpayController;
use App\Http\Controllers\Admin\ManualPaymentController;
use App\Http\Controllers\Payment\FlutterwaveController;
use App\Http\Controllers\Payment\SslCommerzPaymentController;

//Paypal
Route::controller(PayPalController::class)->group(function () {
    Route::post('paypal/payment', 'processTransaction')->name('paypal.post');
    Route::get('success-transaction/{amount}', 'successTransaction')->name('paypal.successTransaction');
    Route::get('cancel-transaction', 'cancelTransaction')->name('paypal.cancelTransaction');
});

// Paystack
Route::controller(PaystackController::class)->group(function () {
    Route::post('paystack/payment', 'redirectToGateway')->name('paystack.post');
    Route::get('/paystack/success', 'successPaystack')->name('paystack.success');
});

// SSLCOMMERZ
Route::controller(SslCommerzPaymentController::class)->prefix('payment')->group(function () {
    Route::post('/pay-via-ajax', 'payViaAjax')->name('ssl.pay');
    Route::post('/success', 'success');
    Route::post('/fail', 'fail');
    Route::post('/cancel', 'cancel');
    Route::post('/ipn', 'ipn');
});

// Flutterwave
Route::controller(FlutterwaveController::class)->group(function () {
    Route::post('/flutterwave/pay', 'initialize')->name('flutterwave.pay');
    Route::get('/rave/callback', 'callback')->name('flutterwave.callback');
});

// Stripe
Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');

// Razorpay
Route::post('payment', [RazorpayController::class, 'payment'])->name('razorpay.post');

// Mollie
Route::post('mollie-paymnet', [MollieController::class, 'preparePayment'])->name('mollie.payment');
Route::get('payment-success', [MollieController::class, 'paymentSuccess'])->name('payment.success');

// Manual Payment
Route::controller(ManualPaymentController::class)->group(function () {
    Route::get('/manual/payment/{order}/mark-paid', 'markPaid')->name('manual.payment.mark.paid');
    Route::get('/manual/payment/details', 'manualPaymentDetails')->name('manual.payment.details');
});
