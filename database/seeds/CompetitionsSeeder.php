<?php

use Illuminate\Database\Seeder;

class CompetitionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $competition = new \App\Models\Competition();

        $competition->name = 'Test Competition';
        $competition->url = 'testcomp.com';
        $competition->description = 'Description 123';
        $competition->online_date = new DateTime('2018-01-01');
        $competition->promo_open_date = new DateTime('2018-02-01');
        $competition->promo_closed_date = new DateTime('2018-03-01');
        $competition->offline_date = new DateTime('2018-04-01');
        $competition->urns_issued = 2500;


        $competition->save();
        //
    }
}
