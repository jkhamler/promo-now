<?php

use Illuminate\Database\Seeder;

class TierItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $partner1 = new \App\Models\Partner();
        $partner1->name = 'Amazon';
        $partner1->save();

        $partner1Id = $partner1->id;

        $partner2 = new \App\Models\Partner();
        $partner2->name = 'Sunday Times';
        $partner2->save();

        $partner2Id = $partner2->id;

        $tier = new \App\Models\Tier();

        $tier->level = 1;
        $tier->short_description = 'Tier 1';
        $tier->long_description = 'Tier 1 Prizes';
        $tier->quantity = 1000;
        $tier->partner_id = $partner1Id;

        $tier->save;



        $item = new \App\Models\TierItem();

        $item->name = 'Test Item';
        $item->url = 'testcomp.com';
        $item->description = 'Description 123';
        $item->online_date = new DateTime('2018-01-01');
        $item->promo_open_date = new DateTime('2018-02-01');
        $item->promo_closed_date = new DateTime('2018-03-01');
        $item->offline_date = new DateTime('2018-04-01');
        $item->urns_issued = 2500;


        $item->save();
        //
    }
}
