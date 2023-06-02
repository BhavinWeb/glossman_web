<?php

namespace Modules\Product\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Brand\Entities\Brand;
use Modules\Category\Entities\Category;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Product\Entities\Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        $id = rand(10, 150);
        $image = 'https://picsum.photos/id/' . $id . '/700/600';
        $title = $this->faker->sentence($nbWords = 8, $variableNbWords = true);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'sku' => rand(1999, 6999),
            'price' => rand(200, 600),
            'sale_price' => rand(0, 1000),
            'stock' => rand(0, 1000),
            'total_views' => rand(0, 500),
            'category_id' => Category::inRandomOrder()->value('id'),
            'brand_id' => Brand::inRandomOrder()->value('id'),
            'image' => $image,
            'short_description' => $this->faker->sentence(3),
            'long_description' => $this->faker->paragraph,
            'featured' => rand(0, 1),
            'hot' => rand(0, 1),
            'total_orders' => rand(100, 200),
            'total_stars' => rand(100, 200),
        ];
    }
}
