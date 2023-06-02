<?php

namespace Modules\Order\Database\factories;

use App\Models\User;
use Modules\Order\Entities\Order;
use Modules\Product\Entities\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Order\Entities\OrderProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => Order::inRandomOrder()->value('id'),
            'product_id' => Product::inRandomOrder()->value('id'),
            'user_id' => 1,
            'price' => $this->faker->randomFloat(2, 0, 100),
            'quantity' => $this->faker->randomNumber(2),
        ];
    }
}
