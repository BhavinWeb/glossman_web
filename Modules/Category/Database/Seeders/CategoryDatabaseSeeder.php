<?php

namespace Modules\Category\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\SubCategory;
use Illuminate\Support\Facades\Http;

class CategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                "name" => 'Electronics',
                "image" => 'dummy/category/electronics.png',
                'show_on_homepage_shop_categories' => 1,
                'show_on_homepage_custom_category' => 1,
            ],
            [
                "name" => 'Fashion',
                "image" => 'dummy/category/fashion.png',
                'show_on_homepage_shop_categories' => 1,
            ],
            [
                "name" => 'Organic',
                "image" => 'dummy/category/organic.png',
                'show_on_homepage_shop_categories' => 1,
            ],
            [
                "name" => 'Groceries',
                "image" => 'dummy/category/grocery.png',
                'show_on_homepage_shop_categories' => 1,
            ],
            [
                "name" => 'Sports & Outdoors',
                "image" => 'dummy/category/sports.png',
                'show_on_homepage_shop_categories' => 1,
            ],
            [
                "name" => 'Furniture',
                "image" => 'dummy/category/furniture.png',
                'show_on_homepage_shop_categories' => 1,
            ],
            [
                "name" => 'Health & Beauty',
                "image" => 'dummy/category/health.png',
                'show_on_homepage_shop_categories' => 1,
            ],
            [
                "name" => 'TV & Homes',
                "image" => 'dummy/category/tv.png',
                'show_on_homepage_shop_categories' => 1,
            ],
            [
                'parent_id' => 1,
                "name" => 'Computer',
            ],
            [
                'parent_id' => 1,
                "name" => 'Laptop',
            ],
            [
                'parent_id' => 1,
                "name" => 'Smartphone',
            ],
            [
                'parent_id' => 1,
                "name" => 'Tablets',
            ],
            [
                'parent_id' => 2,
                "name" => 'Men',
            ],
            [
                'parent_id' => 2,
                "name" => 'Women',
            ],
            [
                'parent_id' => 2,
                "name" => 'Watch',
            ],
            [
                'parent_id' => 2,
                "name" => 'Sunglass',
            ],
            [
                'parent_id' => 5,
                "name" => 'Team Sports',
            ],
            [
                'parent_id' => 5,
                "name" => 'Shoes & Clothing',
            ],
            [
                'parent_id' => 5,
                "name" => 'Fitness Accessories',
            ],
            [
                'parent_id' => 6,
                "name" => 'Table',
            ],
            [
                'parent_id' => 6,
                "name" => 'Chair',
            ],
            [
                'parent_id' => 6,
                "name" => 'Sofa',
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
