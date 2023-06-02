<?php

namespace Modules\Service\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Category\Entities\Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $id = rand(1, 300);
        $image = 'https://picsum.photos/id/' . $id . '/700/600';
        $title = $this->faker->word(1);

        return [
            'name' => $title,
            'image' => $image,
            'slug' => Str::slug($title),
        ];
    }
}
