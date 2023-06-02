<?php

namespace Modules\ShippingMethod\Database\factories;

use Modules\Location\Entities\City;
use Modules\Location\Entities\State;
use Modules\ShippingMethod\Entities\PickupPoint;
use Illuminate\Database\Eloquent\Factories\Factory;

class PickupPointFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\ShippingMethod\Entities\PickupPoint::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'state_id' => State::inRandomOrder()->value('id'),
            'city_id' => City::inRandomOrder()->value('id'),
            'address' => $this->faker->address,
        ];
    }
}
