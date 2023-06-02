<?php

namespace Modules\Order\Database\factories;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Location\Entities\Country;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Order\Entities\Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $country = Country::inRandomOrder()->first();
        $state = $country->states()->inRandomOrder()->first();
        $city = $state->cities()->inRandomOrder()->first();

        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'company_name' => $this->faker->company,
            'address' => $this->faker->address,
            'country_id' => $country->id ?? 1,
            'state_id' => $state->id ?? 2,
            'city_id' => $city->id ?? 3,
            'zip_code' => 1207,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'type' => Arr::random(['shipping', 'billing']),
        ];
    }
}
