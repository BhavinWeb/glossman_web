<?php
namespace Modules\Wishlist\Database\factories;

use App\Models\User;
use Modules\Product\Entities\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class WishlistFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Wishlist\Entities\Wishlist::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->value('id'),
            'product_id' => Product::inRandomOrder()->value('id'),
        ];
    }
}

