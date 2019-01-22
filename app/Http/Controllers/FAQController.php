<?php

namespace App\Http\Controllers;

use App\Models\FAQGroup;
use App\Models\Promotion;

class FAQController extends Controller
{
    public function faqGroupDetailsAction($promotionId, $faqGroupId)
    {
        /** @var Promotion $promotion */
        $promotion = Promotion::find($promotionId);

        /** @var FAQGroup $faqGroup */
        $faqGroup = FAQGroup::find($faqGroupId);

        return view('faq.faq-group', [
            'promotion' => $promotion,
            'faqGroup' => $faqGroup,
        ]);
    }
}
