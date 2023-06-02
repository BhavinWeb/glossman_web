<?php

namespace App\Http\Traits;

use App\Mail\GuestOrderTrackMail;
use App\Models\User;
use App\Models\Admin;
use App\Models\UserPlan;
use App\Models\ManualPayment;
use Modules\Order\Entities\Order;
use Illuminate\Support\Facades\DB;
use Modules\Coupon\Entities\Coupon;
use Illuminate\Support\Facades\Mail;
use Modules\Product\Entities\Product;
use Modules\Order\Entities\Transaction;
use Modules\Order\Entities\OrderProduct;
use Illuminate\Support\Facades\Notification;
use Modules\Order\Entities\OrderProductAttribute;
use Modules\ShippingMethod\Entities\ShippingMethod;
use App\Notifications\Backend\OrderPlacedNotification;
use App\Notifications\Frontend\Customer\OrderStatusNotification;
use App\Notifications\Frontend\Customer\GuestOrderTrackNotification;
use App\Notifications\Frontend\OrderPlacedNotification as FrontendOrderPlacedNotification;

trait PaymentTrait
{
    public function orderPlacing($request = null)
    {
        try {
            $subtotal = \Cart::getSubTotal();
            $order_total = \Cart::getTotal();
            $cart_items = \Cart::getContent();
            $coupon_condition = \Cart::getCondition('Coupon');
            $coupon_code = $coupon_condition && $coupon_condition->getAttributes()['code'];

            if (!count($cart_items)) {
                session()->flash('error', 'Order cart is empty');
                return back();
            }

            $request = $request ? $request : session('order_request');
            $payment_type = $request['payment_type'];

            if ($payment_type == 'offline') {
                $same_address = $request['is_same_address'] ? 0 : 1;
            } else {
                $same_address = $request['is_same_address'] ?? false;
            }

            // Create Order
            $shipping_method = ShippingMethod::where('shipping_type', $request['shipping_method'])->first();
            $pickup_point_id =  $request['shipping_method'] == 'local_pickup' ? $request['pickup_point_id'] : null;

            // Get manual payment
            if ($payment_type == 'offline') {
                $manual_payment = ManualPayment::where('name', $request['payment_method'])->first() ?? '';
            }

            $payment_method = $payment_type == 'offline' ? 'offline' : $request['payment_method'];
            $order = Order::create([
                'order_no' => strtoupper(uniqid()),
                'user_id' => auth('user')->check() ? auth('user')->id():null,
                'total_price' => $order_total + $shipping_method->amount,
                'payment_status' => $payment_type == 'offline' ? 'unpaid' : 'paid',
                'payment_method' => $payment_method,
                'manual_payment_id' => $manual_payment->id ?? '',
                'coupon_type' => $coupon_condition ? $coupon_condition->getType() : '',
                'coupon_discount_amount' => $coupon_condition ? $coupon_condition->getValue() : '',
                'subtotal_price' => $subtotal,
                'notes' => $request['notes'],
                'shipping_method_id' => $shipping_method->id,
                'shipping_pickup_point_id' => $pickup_point_id,
                'guest_email' => $request['guest_email'] ?? null,
                'order_status' => 'pending',
            ]);

            // Create billing and shipping address
            $billing_data = [
                'addressable_id' => $order->id,
                'first_name' => $request['billing_first_name'],
                'last_name' => $request['billing_last_name'],
                'company_name' => $request['billing_company_name'],
                'country_id' => $request['billing_country'],
                'state_id' => $request['billing_state'],
                'city_id' => $request['billing_city'] ?? null,
                'email' => $request['billing_email'],
                'phone' => $request['billing_phone'],
                'address' => $request['billing_address'],
                'zip_code' => $request['billing_zip'],
                'type' => 'billing',
            ];

            if ($same_address) {
                $shipping_data = $billing_data;
                $shipping_data['type'] = 'shipping';
            } else {
                $shipping_data = [
                    'addressable_id' => $order->id,
                    'first_name' => $request['shipping_first_name'],
                    'last_name' => $request['shipping_last_name'],
                    'company_name' => $request['shipping_company_name'],
                    'country_id' => $request['shipping_country'],
                    'state_id' => $request['shipping_state'],
                    'city_id' => $request['shipping_city'] ?? null,
                    'email' => $request['shipping_email'],
                    'phone' => $request['shipping_phone'],
                    'address' => $request['shipping_address'],
                    'zip_code' => $request['shipping_zip'],
                    'type' => 'shipping',
                ];
            }

            $order->billingAddress()->create($billing_data);
            $order->shippingAddress()->create($shipping_data);

            // Create Order Products
            foreach ($cart_items as $content) {
                $order_product = OrderProduct::create([
                    'order_id' => $order->id,
                    'user_id' =>  auth('user')->check() ? auth('user')->id():null,
                    'product_id' => $content->id,
                    'price' => $content->price,
                    'quantity' => $content->quantity
                ]);

                // Order Product Attributes
                if ($content->attributes->attribute && count($content->attributes->attribute)) {
                    foreach ($content->attributes->attribute as $attribute) {
                        OrderProductAttribute::create([
                            'order_product_id' => $order_product->id,
                            'attribute' => $attribute['attribute'],
                            'value' => $attribute['value']
                        ]);
                    }
                }

                // Decrease product quantity && increase sold product quantity
                $product = Product::find($content->id);
                $product->stock = $product->stock - $content->quantity;
                $product->total_orders = $product->total_orders + $content->quantity;
                $product->save();
            }

            // Transaction
            Transaction::create([
                'payment_method' => $request['payment_method'],
                'order_id' => $order->id,
                'user_id' => auth('user')->check() ? auth('user')->id(): null,
                'amount' => $order_total,
            ]);

            // Coupon
            if ($coupon_condition) {
                $coupon_code = $coupon_condition->getAttributes()['code'];
                Coupon::where('code', $coupon_code)->firstOrFail()->increment('total_uses');
            }

            \Cart::clearCartConditions();
            \Cart::clear();
            session()->forget('order_request');
            session(['current_order_no' => $order->order_no]);

            //<!-- Notification for admin about order place -->
            $admins = Admin::all();
            foreach ($admins as $admin) {
                Notification::send($admin, new OrderPlacedNotification($admin, $order));
            }

            //<!-- Notification for customer about order placed -->
            Notification::send($order, new FrontendOrderPlacedNotification($order));

            //<!-- Notification for customer about order status -->
            if (checkMailConfig()) {
                if (auth('user')->check()) {
                    $user = User::FindOrFail($order->user_id);
                    Notification::route('mail', $user->email)->notify(new OrderStatusNotification($user, $order));
                }else{
                    Mail::to($order->guest_email)->send(new GuestOrderTrackMail($order));
                }
            }

            session()->flash('success', 'Order placed successfully');
            return redirect()->route('website.checkout.success')->send();
        } catch (\Exception $e) {
            if (env('APP_DEBUG')) {
                flashError($e->getMessage());
            } else {
                flashError('Something went wrong');
            }

            return back()->send();
        }
    }
}
