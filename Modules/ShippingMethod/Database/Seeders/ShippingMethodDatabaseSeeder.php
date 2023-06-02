<?php

namespace Modules\ShippingMethod\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\ShippingMethod\Entities\PickupPoint;
use Modules\ShippingMethod\Entities\ShippingMethod;

class ShippingMethodDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $shipping_methods = [
            [
                'name' => 'Flat Rate',
                'shipping_type' => 'flat',
                'amount' => 50,
                'status' => true,
            ],
            [
                'name' => 'Free Shipping',
                'shipping_type' => 'free',
                'amount' => 0,
                'status' => true,
            ],
            [
                'name' => 'Local Pickup',
                'shipping_type' => 'local_pickup',
                'amount' => 20,
                'status'  => true,
            ]
        ];

        foreach ($shipping_methods as $method) {
            ShippingMethod::create($method);
        }
    }
}
