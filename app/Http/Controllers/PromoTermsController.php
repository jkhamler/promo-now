<?php

namespace App\Http\Controllers;

use App\Models\Language;
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
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createAction(Request $request)
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

        $promoTerm->save();

        return redirect()->to("/promotions/{$promoTerm->promotion_id}/promo-terms/{$promoTerm->id}");

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
            'shortTerms' => 'required',
            'termsBodyText' => 'required',
        ]);


        /** @var PromoTerm $promoTerm */
        $promoTerm = PromoTerm::find($promoTermId);

        $promoTerm->version = $promoTerm->version + 1;
        $promoTerm->valid_from = Carbon::parse($data['validFrom']);
        $promoTerm->valid_until = Carbon::parse($data['validUntil']);
        $promoTerm->title = $data['title'];
        $promoTerm->acceptance_text = $data['acceptanceText'];
        $promoTerm->short_terms = $data['shortTerms'];
        $promoTerm->terms_body_text = $data['termsBodyText'];
        $promoTerm->updated_by_user_id = Auth::id();

        $promoTerm->save();

        return redirect()->to("/promotions/{$promoTerm->promotion_id}/promo-terms/{$promoTermId}");

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
