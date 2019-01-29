<?php

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country = new \App\Models\Country();
        $country->name = 'United Kingdom';
        $country->iso_code = 'GBR';
        $country->save();

        $country = new \App\Models\Country();
        $country->name = 'Brazil';
        $country->iso_code = 'BRA';
        $country->save();

        $country = new \App\Models\Country();
        $country->name = 'France';
        $country->iso_code = 'FRA';
        $country->save();

        $country = new \App\Models\Country();
        $country->name = 'Germany';
        $country->iso_code = 'DEU';
        $country->save();

        $country = new \App\Models\Country();
        $country->name = 'Norway';
        $country->iso_code = 'NOR';
        $country->save();

    }
}
