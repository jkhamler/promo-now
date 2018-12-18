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
        /** @var \App\Models\Promotion $promotion */
        $promotion = \App\Models\Promotion::where('name', 'Test Promotion')->first();


        $partner1 = new \App\Models\Partner();
        $partner1->name = 'Amazon';
        $partner1->save();

        $partner1Id = $partner1->id;

        $partner2 = new \App\Models\Partner();
        $partner2->name = 'Tesco';
        $partner2->save();

        $partner2Id = $partner2->id;

        $partner3 = new \App\Models\Partner();
        $partner3->name = 'Waitrose';
        $partner3->save();

        $partner3Id = $partner3->id;

        $tier1 = new \App\Models\Tier();

        $tier1->promotion_id = $promotion->id;
        $tier1->level = 1;
        $tier1->short_description = 'Tier 1';
        $tier1->long_description = 'Tier 1 Prizes';
        $tier1->quantity = 1000;

        $tier1->save();

        $tier1Id = $tier1->id;

        $tier2 = new \App\Models\Tier();

        $tier2->promotion_id = $promotion->id;
        $tier2->level = 2;
        $tier2->short_description = 'Tier 2';
        $tier2->long_description = 'Tier 2 Prizes';
        $tier2->quantity = 1000;

        $tier2->save();

        $tier2Id = $tier2->id;

        $item1 = new \App\Models\TierItem();

        $item1->tier_id = $tier1Id;
        $item1->partner_id = $partner1Id;
        $item1->short_description = 'TV';
        $item1->long_description = 'Television';
        $item1->coupon_number = 'ABC12345';

        $item1->save();

        $item1b = new \App\Models\TierItem();

        $item1b->tier_id = $tier1Id;
        $item1b->partner_id = $partner1Id;
        $item1b->short_description = 'iPhone';
        $item1b->long_description = 'iPhone 8';
        $item1b->coupon_number = 'XYZ789';

        $item1b->save();

        $item2 = new \App\Models\TierItem();

        $item2->tier_id = $tier2Id;
        $item2->partner_id = $partner1Id;
        $item2->short_description = 'Car';
        $item2->long_description = 'A Free Car';
        $item2->coupon_number = 'ABC789';

        $item2->save();
    }
}
