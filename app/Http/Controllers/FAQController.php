<?php

namespace App\Http\Controllers;

use App\Models\FAQGroup;
use App\Models\Promotion;
use Illuminate\Http\Request;

class FAQController extends Controller
{

    /**
     * @param $promotionId
     * @param $faqGroupId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * @param $promotionId
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createFAQGroupAction($promotionId, Request $request)
    {

        $data = $request->all();

        $request->validate([
            'promotionId' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);

        $faqGroup = new FAQGroup();

        $faqGroup->promotion_id = $data['promotionId'];
        $faqGroup->name = $data['name'];
        $faqGroup->description = $data['description'];

        $faqGroup->save();

        return redirect()->to(route('FAQGroupDetails', [$promotionId, $faqGroup->id]));
    }

    /**
     * @param $promotionId
     * @param $faqGroupId
     * @param Request $request
     */
    public function updateFAQGroupAction($promotionId, $faqGroupId, Request $request)
    {

    }
}
