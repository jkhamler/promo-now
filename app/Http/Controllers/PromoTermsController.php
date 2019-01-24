<?php

namespace App\Http\Controllers;

use App\Models\PromoTerm;
use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromoTermsController extends Controller
{
    /**
     * Creates a new promo terms record (version 1)
     *
     * @param $promotionId
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createAction($promotionId, Request $request)
    {
        $data = $request->all();

        $request->validate([
            'promotionId' => 'required',
            'validFrom' => 'required|date',
            'validUntil' => 'required|date|after:validFrom',
            'title' => 'required',
            'acceptanceText' => 'required',
            'shortTerms' => 'required',
            'termsBodyText' => 'required',
        ]);

        $promoTerm = new PromoTerm();

        $promoTerm->promotion_id = $data['promotionId'];
        $promoTerm->version = 1;
        $promoTerm->valid_from = Carbon::parse($data['validFrom']);
        $promoTerm->valid_until = Carbon::parse($data['validUntil']);
        $promoTerm->title = $data['title'];
        $promoTerm->acceptance_text = $data['acceptanceText'];
        $promoTerm->short_terms = $data['shortTerms'];
        $promoTerm->terms_body_text = $data['termsBodyText'];
        $promoTerm->created_by_user_id = Auth::id();

        $promoTerm->save();

        return redirect()->to(route('promoTermDetails', [$promotionId, $promoTerm->id]));
    }

    /**
     * @param $promoTermId
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAction($promoTermId, Request $request)
    {

        $data = $request->all();

        $request->validate([
            'validFrom' => 'required|date',
            'validUntil' => 'required|date|after:validFrom',
            'title' => 'required',
            'acceptanceText' => 'required',
            'shortTerms' => 'string|nullable',
            'termsBodyText' => 'required',
        ]);

        /** @var PromoTerm $promoTerm */
        $promoTerm = PromoTerm::find($promoTermId);

        $revisedPromoTerm = new PromoTerm();

        $revisedPromoTerm->promotion_id = $promoTerm->promotion_id;
        $revisedPromoTerm->version = $promoTerm->version + 1;
        $revisedPromoTerm->valid_from = Carbon::parse($data['validFrom']);
        $revisedPromoTerm->valid_until = Carbon::parse($data['validUntil']);
        $revisedPromoTerm->title = $data['title'];
        $revisedPromoTerm->acceptance_text = $data['acceptanceText'];
        $revisedPromoTerm->short_terms = $data['shortTerms'];
        $revisedPromoTerm->terms_body_text = $data['termsBodyText'];
        $revisedPromoTerm->updated_by_user_id = Auth::id();

        $revisedPromoTerm->save();

        return redirect()->to("/promotions/{$promoTerm->promotion_id}/promo-terms/{$revisedPromoTerm->id}");

    }

    /**
     * Promo Terms Details
     *
     * @param $promotionId
     * @param $promoTermsId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detailsAction($promotionId, $promoTermsId)
    {
        /** @var Promotion $promotion */
        $promotion = Promotion::find($promotionId);

        /** @var PromoTerm $promoTerm */
        $promoTerm = PromoTerm::find($promoTermsId);

        return view('promotion.terms.promo-terms', [
            'promotion' => $promotion,
            'promoTerm' => $promoTerm,
        ]);
    }

}
