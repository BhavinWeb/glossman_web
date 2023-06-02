<?php

namespace Modules\Product\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Modules\Brand\Entities\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Modules\Product\Entities\Product;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Modules\Product\Entities\ProductTag;
use Modules\Product\Entities\ProductGallery;

class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductTag::factory(30)->create();

        $product_list = json_decode(file_get_contents(base_path('public/dummy/products.json')), true);

        for ($i = 0; $i < count($product_list); $i++) {
            $product_data[] = [
                'title' => $product_list[$i]['title'],
                'slug' => str_slug($product_list[$i]['title']),
                'image' => $product_list[$i]['image'],
                'sku' => rand(1999, 6999),
                'price' => rand(200, 6000),
                'sale_price' => rand(0, 1000),
                'stock' => rand(0, 1000),
                'total_views' => rand(0, 500),
                'featured' => rand(0, 1),
                'hot' => rand(0, 1),
                'total_orders' => rand(100, 200),
                'total_stars' => rand(100, 200),
                'category_id' => $product_list[$i]['category'],
                'brand_id' => Brand::inRandomOrder()->value('id'),

                'short_description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",

                'long_description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",

                'specification' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",

                'additional_information' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
            ];
        }

        $product_chunks = array_chunk($product_data, ceil(count($product_data) / 3));

        foreach ($product_chunks as $product) {
            Product::insert($product);
        }

        ProductGallery::factory(100)->create();

        for ($i = 0; $i < 9; $i++) {
            DB::table('todays_deal_products')->insert([
                'product_id' => Product::inRandomOrder()->value('id'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        foreach (Product::all() as $product) {
            $product->productTags()->attach(ProductTag::inRandomOrder()->take(rand(1, 3))->pluck('id'));
        }

        for ($i = 0; $i < 9; $i++) {
            DB::table('todays_deal_products')->insert([
                'product_id' => Product::inRandomOrder()->value('id'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
