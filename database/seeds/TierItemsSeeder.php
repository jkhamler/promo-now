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

        $tier1 = new \App\Models\Tier();

        $tier1->level = 1;
        $tier1->short_description = 'Tier 1';
        $tier1->long_description = 'Tier 1 Prizes';
        $tier1->quantity = 1000;

        $tier1->save();

        $tier1Id = $tier1->id;

        $tier2 = new \App\Models\Tier();

        $tier2->level = 2;
        $tier2->short_description = 'Tier 2';
        $tier2->long_description = 'Tier 2 Prizes';
        $tier2->quantity = 1000;

        $tier2->save();

        $tier2Id = $tier2->id;

        $item1 = new \App\Models\TierItem();

        $item1->tier_id = $tier1Id;
        $item1->partner_id = $partner1Id;
        $item1->level = 1;
        $item1->short_description = 'TV';
        $item1->long_description = 'Television';
        $item1->coupon_number = 'ABC12345';
        $item1->quantity = 250;

        $item1->save();

        $item2 = new \App\Models\TierItem();

        $item2->tier_id = $tier2Id;
        $item2->partner_id = $partner1Id;
        $item2->level = 2;
        $item2->short_description = 'Car';
        $item2->long_description = 'A Free Car';
        $item2->coupon_number = 'ABC789';
        $item2->quantity = 50;

        $item2->save();
    }
}
