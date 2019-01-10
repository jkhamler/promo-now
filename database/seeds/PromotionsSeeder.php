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

        $urnSpecification = new \App\Models\UrnSpecification();
        $urnSpecification->reference_id = 'Test URN Reference ID';
        $urnSpecification->promotion_id = $promotion->id;
        $urnSpecification->purpose = \App\Models\UrnSpecification::URN_PURPOSE_PI_TESTING;
        $urnSpecification->length = 350;
        $urnSpecification->included_characters = 'ABCD1234';
        $urnSpecification->regex_exclude = '^123ABC$';
        $urnSpecification->profanity_check_language_id = 1;
        $urnSpecification->urn_quantity = 10000;
        $urnSpecification->winning_urn_quantity = 50;
        $urnSpecification->pi_to_generate = true;
        $urnSpecification->everyone_gets = false;
        $urnSpecification->allocated_by_tier = true;

        $urnSpecification->save();

    }
}
