<?php

namespace Modules\Order\Database\factories;

use App\Models\ManualPayment;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\ShippingMethod\Entities\PickupPoint;
use Modules\ShippingMethod\Entities\ShippingMethod;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Order\Entities\Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $shipping_method = ShippingMethod::inRandomOrder()->first();
        $pickup_point_id = PickupPoint::inRandomOrder()->value('id');

        return [
            'order_no' => $this->faker->unique()->randomNumber(6),
            'user_id' => 1,
            'total_price' => $this->faker->randomDigit,
            'discount_price' => 40,
            'payment_status' => Arr::random(['paid', 'unpaid']),
            'payment_method' => Arr::random(['offline', 'paypal', 'stripe', 'razorpay', 'paystack', 'flutterwave', 'mollie', 'sslcommerz']),
            'manual_payment_id' => ManualPayment::inRandomOrder()->value('id'),
            'order_status' => Arr::random(['pending', 'processing', 'on_the_way', 'delivered', 'cancelled']),
            'shipping_method_id' => $shipping_method->id,
            'shipping_pickup_point_id' => $shipping_method->shipping_type == 'local_pickup' ? $pickup_point_id : null,
            'payment_status' => 'paid',
        ];
    }
}
