<?php

namespace Modules\Attribute\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Attribute\Entities\AttributeValue;

class AttributeValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $sizes = ['Small', 'Medium', 'Large'];
        $colors = ['Black', 'Blue', 'Red', 'Orange'];

        foreach ($sizes as $size) {
            AttributeValue::create([
                'attribute_id'      =>  1,
                'value'             =>  $size,
            ]);
        }

        foreach ($colors as $color) {
            AttributeValue::create([
                'attribute_id'      =>  2,
                'value'             =>  $color,
            ]);
        }

        // $this->call("OthersTableSeeder");
    }
}
