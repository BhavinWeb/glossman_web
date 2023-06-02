<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use Modules\Order\Entities\Order;
use App\Http\Controllers\Controller;
use App\Services\Midtrans\CreateSnapTokenService; // => put it at the top of the class

class MidtransController extends Controller
{
    public function show(Order $order)
    {
        $snapToken = $order->snap_token;
        if (is_null($snapToken)) {
            // If snap token is still NULL, generate snap token and save it to database

            $midtrans = new CreateSnapTokenService($order);
            $snapToken = $midtrans->getSnapToken();

            $order->snap_token = $snapToken;
            $order->save();
        }

        return view('orders.show', compact('order', 'snapToken'));
    }
}
