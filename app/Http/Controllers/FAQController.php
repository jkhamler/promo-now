<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use App\Models\FAQGroup;
use App\Models\Promotion;
use Illuminate\Database\Eloquent\Collection;
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateFAQGroupAction($promotionId, $faqGroupId, Request $request)
    {
        $data = $request->all();

        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        /** @var FAQGroup $faqGroup */
        $faqGroup = FAQGroup::find($faqGroupId);

        $faqGroup->name = $data['name'];
        $faqGroup->description = $data['description'];

        $faqGroup->save();

        return redirect()->to(route('FAQGroupDetails', [$promotionId, $faqGroupId]));
    }

    /**
     * @param $promotionId
     * @param $faqGroupId
     * @param $faqId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function FAQDetailsAction($promotionId, $faqGroupId, $faqId)
    {
        /** @var FAQGroup $faq */
        $faqGroup = FAQGroup::find($faqGroupId);

        /** @var FAQ $faq */
        $faq = FAQ::find($faqId);

        return view('faq.faq-details', [
            'faqGroup' => $faqGroup,
            'faq' => $faq,
        ]);

    }

    /**
     * @param $promotionId
     * @param $faqGroupId
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createFAQAction($promotionId, $faqGroupId, Request $request)
    {
        $data = $request->all();

        $request->validate([
            'title' => 'required',
            'bodyText' => 'required',
        ]);

        /** @var FAQGroup $faqGroup */
        $faqGroup = FAQGroup::find($faqGroupId);

        /** @var Collection $existingFAQs */
        $existingFAQs = $faqGroup->faqs;

        /** @var FAQ $lastFAQ */
        $lastFAQ = $existingFAQs->last();


        /** @var FAQ $faq */
        $faq = new FAQ();

        $faq->faq_group_id = $faqGroupId;
        $faq->title = $data['title'];
        $faq->body_text = $data['bodyText'];
        $faq->order = $lastFAQ ? $lastFAQ->order + 1 : 1;

        $faq->save();

        return redirect()->to(route('FAQDetails', [$promotionId, $faqGroupId, $faq->id]));
    }

    /**
     * @param $promotionId
     * @param $faqGroupId
     * @param $faqId
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateFAQAction($promotionId, $faqGroupId, $faqId, Request $request)
    {
        $data = $request->all();

        $request->validate([
            'order' => 'required',
            'title' => 'required',
            'bodyText' => 'required',
        ]);

        /** @var FAQ $faq */
        $faq = FAQ::find($faqId);

        $faq->order = $data['order'];
        $faq->title = $data['title'];
        $faq->body_text = $data['bodyText'];

        $faq->save();

        return redirect()->to(route('FAQDetails', [$promotionId, $faqGroupId, $faq->id]));

    }

    /**
     * @param $promotionId
     * @param $faqGroupId
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function reorderFAQsAction($promotionId, $faqGroupId, Request $request)
    {
        foreach ($request->input('order') as $faqOrder) {
            if (array_key_exists('id', $faqOrder)) {
                /** @var FAQ $faq */
                $faq = FAQ::find($faqOrder['id']);

                $faq->order = $faqOrder['position'];
                $faq->save();
            }
        }
        return response(['status' => 'success']);
    }

    /**
     * @return array
     */
    public function FAQListDataAction($promotionId, $faqGroupId)
    {
        /** @var FAQGroup $faqGroup */
        $faqGroup = FAQGroup::find($faqGroupId);

        $data = [];

        /** @var FAQ $faq */
        foreach ($faqGroup->faqs as $faq) {

            $data[] = [
                'DT_RowId' => $faq->id,
                'order' => $faq->order,
                'title' => $faq->title,
                'body_text' => $faq->body_text,
            ];

        }

        return [
            'data' => $data
        ];
    }

}
