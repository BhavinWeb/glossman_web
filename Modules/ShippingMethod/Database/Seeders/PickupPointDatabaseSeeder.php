<?php

namespace Modules\ShippingMethod\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\ShippingMethod\Entities\PickupPoint;

class PickupPointDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PickupPoint::factory(10)->create();
        // $this->call("OthersTableSeeder");
    }
}
