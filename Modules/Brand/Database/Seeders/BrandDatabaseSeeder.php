<?php

namespace Modules\Brand\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Brand\Entities\Brand;
use Illuminate\Support\Facades\Http;

class BrandDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Model::unguard();

        // Brand::factory(5)->create();

        $brands = Http::get('https://dummyjson.com/products?select=brand');
        foreach ($brands['products'] as $brand) {
            if ($brand['brand'] != null && !Brand::where('slug', str_slug($brand['brand']))->exists()) {
                Brand::create([
                    'name' => $brand['brand'],
                ]);
            }
        }
    }
}
