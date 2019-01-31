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

        $promotion->name = 'Everybody Gets Test Promotion';
        $promotion->url = 'testcomp.com';
        $promotion->description = 'Description 123';
        $promotion->online_date = new DateTime('2018-01-01');
        $promotion->promo_open_date = new DateTime('2018-02-01');
        $promotion->promo_closed_date = new DateTime('2018-03-01');
        $promotion->offline_date = new DateTime('2018-04-01');
        $promotion->urns_required = true;
        $promotion->urns_issued = 50;

        $promotion->save();

        $promoTerm = new \App\Models\PromoTerm();
        $promoTerm->promotion_id = $promotion->id;
        $promoTerm->valid_from = new DateTime('2018-01-01');
        $promoTerm->valid_until = new DateTime('2019-01-01');
        $promoTerm->title = 'Test Promotion Terms';
        $promoTerm->acceptance_text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.';
        $promoTerm->short_terms = 'Short Terms Text 123123123123';
        $promoTerm->terms_body_text = 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.';
        $promoTerm->version = 1;

        $promoTerm->save();

        $privacyTerm = new \App\Models\PrivacyTerm();
        $privacyTerm->promotion_id = $promotion->id;
        $privacyTerm->partner_id = 1;
        $privacyTerm->title = 'Test Privacy Terms';
        $privacyTerm->acceptance_text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.';
        $privacyTerm->terms_body_text = 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.';
        $privacyTerm->marketing_opt_in = 'Test Marketing Opt In Text';
        $privacyTerm->cookie_title = 'Test Privacy Terms Cookie Title';
        $privacyTerm->cookie_body_text = 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.';
        $privacyTerm->gdpr_contact_email = 'gdpr@email.com';

        $privacyTerm->version = 1;

        $privacyTerm->save();

        $urnSpecification = new \App\Models\UrnSpecification();
        $urnSpecification->reference_id = 'Test URN Reference ID';
        $urnSpecification->promotion_id = $promotion->id;
        $urnSpecification->purpose = \App\Models\UrnSpecification::URN_PURPOSE_PI_TESTING;
        $urnSpecification->length = 350;
        $urnSpecification->included_characters = 'ABCD1234';
        $urnSpecification->regex_exclude = '^123ABC$';
        $urnSpecification->profanity_check_language_id = 1;
        $urnSpecification->urn_quantity = 50;
        $urnSpecification->winning_urn_quantity = 10;
        $urnSpecification->pi_to_generate = true;
        $urnSpecification->everyone_gets = false;
        $urnSpecification->allocated_by_tier = true;

        $urnSpecification->save();

        $mechanic1 = new \App\Models\Mechanic();
        $mechanic1->type = \App\Models\Mechanic::MECHANIC_TYPE_EVERYBODY_GETS;

        $mechanic1->name = 'Everybody Gets 123';
        $mechanic1->description = 'Everybody Gets 123 Description';
        $mechanic1->promotion_id = $promotion->id;
        $mechanic1->urn_specification_id = $urnSpecification->id;
        $mechanic1->tier_item_id = 1;

        $mechanic1->save();

        $urnBatch = new \App\Models\UrnBatch();
        $urnBatch->urn_specification_id = $urnSpecification->id;
        $urnBatch->batch_name = 'Batch 1';

        $urnBatch->save();

        for ($i = 0; $i < 50; $i++) {

            $urn = new \App\Models\Urn();
            $urn->urn_batch_id = $urnBatch->id;
            $urn->urn = "ABCD{$i}";
            $urn->save();
        }

        $faqGroupGeneral = new \App\Models\FAQGroup();
        $faqGroupGeneral->promotion_id = $promotion->id;
        $faqGroupGeneral->name = 'General';
        $faqGroupGeneral->description = 'General FAQs';
        $faqGroupGeneral->save();

        $generalFaq = new \App\Models\FAQ();
        $generalFaq->faq_group_id = $faqGroupGeneral->id;
        $generalFaq->title = 'Am I eligible?';
        $generalFaq->body_text = 'To be eligible you must be a UK resident over 18 years of age..';
        $generalFaq->order = 1;
        $generalFaq->save();

        $generalFaq = new \App\Models\FAQ();
        $generalFaq->faq_group_id = $faqGroupGeneral->id;
        $generalFaq->title = 'What can I win?';
        $generalFaq->body_text = 'You can win some amazing prizes shown on the promo site...';
        $generalFaq->order = 2;
        $generalFaq->save();

        $faqGroupPrizeClaiming = new \App\Models\FAQGroup();
        $faqGroupPrizeClaiming->promotion_id = $promotion->id;
        $faqGroupPrizeClaiming->name = 'Claiming Prizes';
        $faqGroupPrizeClaiming->description = 'Claiming Prizes FAQs';
        $faqGroupPrizeClaiming->save();

        $generalFaq = new \App\Models\FAQ();
        $generalFaq->faq_group_id = $faqGroupPrizeClaiming->id;
        $generalFaq->title = 'How do I claim my prize?';
        $generalFaq->body_text = 'To claim your prize please blah blah blah blah';
        $generalFaq->order = 1;
        $generalFaq->save();

        $generalFaq = new \App\Models\FAQ();
        $generalFaq->faq_group_id = $faqGroupPrizeClaiming->id;
        $generalFaq->title = 'Is there a time limit?';
        $generalFaq->body_text = 'You must claim your prize before blah blah blah';
        $generalFaq->order = 2;
        $generalFaq->save();


    }
}
