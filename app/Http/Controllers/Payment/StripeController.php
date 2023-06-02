<?php

namespace App\Http\Controllers\Payment;

use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Modules\Plan\Entities\Plan;
use App\Http\Traits\PaymentTrait;
use App\Http\Controllers\Controller;
use App\Notifications\MembershipUpgradeNotification;

class StripeController extends Controller
{
    use PaymentTrait;

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        try {
            Stripe::setApiKey(config('zakirsoft.stripe_secret'));

            $this->orderPlacing();
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
