<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ManualPayment;
use Modules\Order\Entities\Order;
use App\Http\Controllers\Controller;

class ManualPaymentController extends Controller
{

    public function markPaid(Order $order)
    {
        $order->update([
            'payment_status' => 'paid',
        ]);

        session()->flash('success', 'Payment mark as paid.');
        return back();
    }

    public function manualPaymentDetails(Request $request)
    {
        $name = $request->name;

        $manual_payment = ManualPayment::where('name', $name)->first(['id', 'name', 'description']);

        return $manual_payment;
    }
}
