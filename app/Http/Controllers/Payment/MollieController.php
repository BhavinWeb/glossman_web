<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Traits\PaymentTrait;
use Mollie\Laravel\Facades\Mollie;
use App\Http\Controllers\Controller;

class MollieController extends Controller
{
    use PaymentTrait;

    public function  __construct()
    {
        Mollie::api()->setApiKey(config('zakirsoft.mollie_key')); // your mollie test api key
    }

    /**
     * Redirect the user to the Payment Gateway.
     *
     * @return Response
     */
    public function preparePayment(Request $request)
    {
        $amount = $request->amount;
        $decimal_amount =  number_format((float)$amount, 2, '.', '');

        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => 'USD', // Type of currency you want to send
                'value' => $decimal_amount, // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            'description' => 'Payment By ' . auth('user')->user()->name ?? 'guest',
            'redirectUrl' => route('payment.success'), // after the payment completion where you to redirect
        ]);

        $payment = Mollie::api()->payments()->get($payment->id);

        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }

    /**
     * Page redirection after the successfull payment
     *
     * @return Response
     */
    public function paymentSuccess()
    {
        $this->orderPlacing();
    }
}
