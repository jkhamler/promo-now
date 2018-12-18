<?php

use Illuminate\Database\Seeder;

class PromotionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $promotion = new \App\Models\Promotion();

        $promotion->name = 'Test Promotion';
        $promotion->url = 'testcomp.com';
        $promotion->description = 'Description 123';
        $promotion->online_date = new DateTime('2018-01-01');
        $promotion->promo_open_date = new DateTime('2018-02-01');
        $promotion->promo_closed_date = new DateTime('2018-03-01');
        $promotion->offline_date = new DateTime('2018-04-01');
        $promotion->urns_required = true;
        $promotion->urns_issued = 2500;

        $promotion->save();
        //

        $mechanic1 = new \App\Models\Mechanic();
        $mechanic1->type = \App\Models\Mechanic::MECHANIC_TYPE_TIMED_DRAW;

        $mechanic1->name = 'Timed Draw 123';
        $mechanic1->description = 'Timed Draw 123 Description';
        $mechanic1->promotion_id = $promotion->id;

        $mechanic1->save();

    }
}
