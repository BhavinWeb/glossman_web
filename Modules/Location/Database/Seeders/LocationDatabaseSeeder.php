<?php

namespace Modules\Location\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Modules\Location\Entities\City;
use Modules\Location\Entities\Town;
use Modules\Location\Entities\State;
use Modules\Location\Entities\Country;
use Illuminate\Database\Eloquent\Model;
use Modules\Country\Entities\Country as EntitiesCountry;

class LocationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->makeCountry();
        $this->makeState();
        $this->makeCity();
    }

    protected function makeCountry()
    {
        $countries_list = json_decode(file_get_contents(base_path('public/json/country.json')), true);

        for ($i = 0; $i < count($countries_list); $i++) {
            $country_data[] = [
                'name' => $countries_list[$i]['name'],
                'sortname' => $countries_list[$i]['sortname'],
                'slug' => Str::slug($countries_list[$i]['name']),
                'image' => 'backend/image/flags/flag-of-' . str_replace(" ", "-", $countries_list[$i]['name'] . '.jpg'),
                'icon' => 'flag-icon-' . Str::lower($countries_list[$i]['sortname']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }

        $country_chunks = array_chunk($country_data, ceil(count($country_data) / 3));

        foreach ($country_chunks as $country) {
            Country::insert($country);
        }
    }

    protected function makeState()
    {
        $state_list = json_decode(file_get_contents(base_path('public/json/state.json')), true);

        for ($i = 0; $i < count($state_list); $i++) {
            $state_data[] = [
                'country_id' => $state_list[$i]['country_id'],
                'name' => $state_list[$i]['name'],
                'slug' => Str::slug($state_list[$i]['name']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }

        $state_chunks = array_chunk($state_data, 2000);

        foreach ($state_chunks as $state) {
            State::insert($state);
        }
    }

    protected function makeCity()
    {
        $city_list = json_decode(file_get_contents(base_path('public/json/city.json')), true);

        for ($i = 0; $i < count($city_list); $i++) {
            $city_data[] = [
                'state_id' => $city_list[$i]['state_id'],
                'name' => $city_list[$i]['name'],
                'slug' => Str::slug($city_list[$i]['name']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }

        $city_chunks = array_chunk($city_data, 10000);

        foreach ($city_chunks as $city) {
            City::insert($city);
        }
    }
}
