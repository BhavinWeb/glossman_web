<?php

namespace Modules\Slider\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Slider\Entities\Slider;

class SliderDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");

        $sliders = [
            [
                'title' => 'Slider 1',
                'sub_title' => 'Sub Title',
                'details' => 'Dolor dolor minim enim qui ex consequat eiusmod.',
                'price' => '200',
                'image' => 'frontend/image/banner/x-box.png'
            ],
            [
                'title' => 'Slider 2',
                'sub_title' => 'Sub Title 2',
                'details' => 'Dolor dolor minim enim qui ex consequat eiusmod.',
                'price' => '300',
                'image' => 'frontend/image/banner/x-box.png'
            ],
            [
                'title' => 'Slider 3',
                'sub_title' => 'Sub Title 3',
                'details' => 'Dolor dolor minim enim qui ex consequat eiusmod.',
                'price' => '400',
                'image' => 'frontend/image/banner/x-box.png'
            ],
        ];

        foreach ($sliders as $slider) {
            Slider::create($slider);
        }
    }
}
