<?php

namespace Modules\Order\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Order\Entities\Order;
use Modules\Order\Entities\Address;
use Modules\Review\Entities\Review;
use Illuminate\Database\Eloquent\Model;
use Modules\Order\Entities\OrderProduct;

class OrderDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Order::factory(100)->create()->each(function ($order) {
            $order->billingAddress()->save(Address::factory()->create([
                'addressable_id' => $order->id,
                'addressable_type' => Order::class,
                'type' => 'billing',
            ]));

            $order->shippingAddress()->save(Address::factory()->create([
                'addressable_id' => $order->id,
                'addressable_type' => Order::class,
                'type' => 'shipping',
            ]));
        });

        OrderProduct::factory(100)->create();
        // Review::factory(100)->create();
    }
}
