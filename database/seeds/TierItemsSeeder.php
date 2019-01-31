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
        $promotion = \App\Models\Promotion::where('name', 'Everybody Gets Test Promotion')->first();


        $partner1 = new \App\Models\Partner();
        $partner1->name = 'Amazon';
        $partner1->legal_name = 'Amazon PLC';
        $partner1->description = 'Largest Online Retails';
        $partner1->company_number = 'AMAZ12345';
        $partner1->save();

        $partner1Id = $partner1->id;

        $partner2 = new \App\Models\Partner();
        $partner2->name = 'Tesco';
        $partner2->legal_name = 'Tesco PLC';
        $partner2->description = 'Largest UK Food Retailer';
        $partner2->company_number = 'TESC12345';
        $partner2->save();

        $partner2Id = $partner2->id;

        $partner3 = new \App\Models\Partner();
        $partner3->name = 'Waitrose';
        $partner3->legal_name = 'Waitrose PLC';
        $partner3->description = 'Middle class food';
        $partner3->company_number = 'WAIT12345';
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

        $item1 = $tier1->addItem($partner1Id, 'TV', 'Television', 'ABC12345', 50);

        for ($i = 0; $i < 50; $i++) {
            $tierItemStock = new \App\Models\TierItemStock();
            $tierItemStock->tier_item_id = $item1->id;
            $tierItemStock->reference_number = 'TVREF' . $i;
            $tierItemStock->save();
        }

        $item1b = $tier1->addItem($partner1Id, 'iPhone', 'iPhone 8', 'XYZ789', 100);

        for ($i = 0; $i < 100; $i++) {
            $tierItemStock = new \App\Models\TierItemStock();
            $tierItemStock->tier_item_id = $item1b->id;
            $tierItemStock->reference_number = 'IPHONEREF' . $i;
            $tierItemStock->save();
        }

        $item2 = $tier2->addItem($partner3Id, 'Car', 'A Free Car', 'ABC789', 250);

        for ($i = 0; $i < 250; $i++) {
            $tierItemStock = new \App\Models\TierItemStock();
            $tierItemStock->tier_item_id = $item2->id;
            $tierItemStock->reference_number = 'CARREF' . $i;
            $tierItemStock->save();
        }

    }
}
