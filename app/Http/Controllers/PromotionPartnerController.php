<?php

namespace App\Http\Controllers;

use App\Models\PromotionPartner;
use Illuminate\Http\Request;

class PromotionPartnerController extends Controller
{
    /**
     * @param $promotionId
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createAction($promotionId, Request $request)
    {
        $data = $request->all();

        $request->validate([
            'promotionId' => 'required',
            'partnerId' => 'required',
            'purpose' => 'required',
            'notes' => 'required',
        ]);

        $promotionPartner = new PromotionPartner();

        $promotionPartner->promotion_id = $promotionId;
        $promotionPartner->partner_id = $data['partnerId'];
        $promotionPartner->purpose = $data['purpose'];
        $promotionPartner->notes = $data['notes'];

        $promotionPartner->save();

        return redirect()->to(route('promotionDetails', [$promotionId]));

    }

    /**
     * @param $promotionId
     * @param $promotionPartnerId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detailsAction($promotionId, $promotionPartnerId){

        /** @var PromotionPartner $promotionPartner */
        $promotionPartner = PromotionPartner::find($promotionPartnerId);

        return view('promotion.partner.details', [
            'promotionPartner' => $promotionPartner,
        ]);

    }

}
