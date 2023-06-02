<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Traits\PaymentTrait;
use App\Http\Controllers\Controller;
use KingFlamez\Rave\Facades\Rave as Flutterwave;

class FlutterwaveController extends Controller
{
    use PaymentTrait;

    /**
     * Initialize Rave payment process
     * @return void
     */
    public function initialize()
    {
        //This generates a payment reference
        $reference = Flutterwave::generateReference();

        // Enter the details of the payment
        $data = [
            'payment_options' => 'card,banktransfer',
            'amount' => request()->amount,
            'email' => auth('user')->user()->email ?? 'guest@mail.com',
            'tx_ref' => $reference,
            'currency' => "USD",
            'redirect_url' => route('flutterwave.callback'),
            'customer' => [
                'email' => auth('user')->user()->email ?? 'guest@mail.com',
                "phone_number" => '123456789',
                "name" => auth('user')->user()->name ?? 'guest'
            ],

            "customizations" => [
                "title" => "payment for the product you bought",
                "description" => date('Y-m-d H:i:s'),
            ]
        ];

        $payment = Flutterwave::initializePayment($data);


        if ($payment['status'] !== 'success') {
            // notify something went wrong
            return;
        }

        return redirect($payment['data']['link']);
    }

    /**
     * Obtain Rave callback information
     * @return void
     */
    public function callback()
    {

        $status = request()->status;

        //if payment is successful
        if ($status ==  'successful') {

            $transactionID = Flutterwave::getTransactionIDFromCallback();
            $data = Flutterwave::verifyTransaction($transactionID);

            $this->orderPlacing();

            dd($data);
        } elseif ($status ==  'cancelled') {
            //Put desired action/code after transaction has been cancelled here
        } else {
            //Put desired action/code after transaction has failed here
        }

    }
}
