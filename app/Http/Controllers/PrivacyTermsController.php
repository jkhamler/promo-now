<?php

namespace App\Http\Controllers;

use App\Models\PrivacyTerm;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrivacyTermsController extends Controller
{
    /**
     * Creates a new privacy terms record (version 1)
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createAction(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'promotionId' => 'required',
            'partnerId' => 'required',
            'title' => 'required',
            'acceptanceText' => 'required',
            'privacyTermsBodyText' => 'required',
            'marketingOptIn' => 'required',
            'cookieTitle' => 'required',
            'cookieBodyText' => 'required',
            'gdprEmail' => 'required|email',
        ]);

        $privacyTerm = new PrivacyTerm();

        $privacyTerm->promotion_id = $data['promotionId'];
        $privacyTerm->partner_id = $data['partnerId'];
        $privacyTerm->version = 1;
        $privacyTerm->title = $data['title'];
        $privacyTerm->acceptance_text = $data['acceptanceText'];
        $privacyTerm->terms_body_text = $data['privacyTermsBodyText'];
        $privacyTerm->marketing_opt_in = $data['marketingOptIn'];
        $privacyTerm->cookie_title = $data['cookieTitle'];
        $privacyTerm->cookie_body_text = $data['cookieBodyText'];
        $privacyTerm->gdpr_contact_email = $data['gdprEmail'];
        $privacyTerm->created_by_user_id = Auth::id();

        $privacyTerm->save();

        return redirect()->to("/promotions/{$privacyTerm->promotion_id}/privacy-terms/{$privacyTerm->id}");

    }

    /**
     * @param $privacyTermId
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAction($privacyTermId, Request $request)
    {
        $data = $request->all();

        $request->validate([
            'title' => 'required',
            'acceptanceText' => 'required',
            'privacyTermsBodyText' => 'required',
            'marketingOptIn' => 'required',
            'cookieTitle' => 'required',
            'cookieBodyText' => 'required',
            'gdprEmail' => 'required',
        ]);

        /** @var PrivacyTerm $privacyTerm */
        $privacyTerm = PrivacyTerm::find($privacyTermId);

        $revisedPrivacyTerm = new PrivacyTerm();

        $revisedPrivacyTerm->promotion_id = $privacyTerm->promotion_id;
        $revisedPrivacyTerm->partner_id = $privacyTerm->partner_id;
        $revisedPrivacyTerm->version = $privacyTerm->version + 1;
        $revisedPrivacyTerm->title = $data['title'];
        $revisedPrivacyTerm->acceptance_text = $data['acceptanceText'];
        $revisedPrivacyTerm->terms_body_text = $data['privacyTermsBodyText'];
        $revisedPrivacyTerm->marketing_opt_in = $data['marketingOptIn'];
        $revisedPrivacyTerm->cookie_title = $data['cookieTitle'];
        $revisedPrivacyTerm->cookie_body_text = $data['cookieBodyText'];
        $revisedPrivacyTerm->gdpr_contact_email = $data['gdprEmail'];

        $revisedPrivacyTerm->save();

        return redirect()->to("/promotions/{$privacyTerm->promotion_id}/privacy-terms/{$revisedPrivacyTerm->id}");

    }

    /**
     * Privacy Terms Details
     *
     * @param $promotionId
     * @param $privacyTermId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detailsAction($promotionId, $privacyTermId)
    {
        /** @var Promotion $promotion */
        $promotion = Promotion::find($promotionId);

        /** @var PrivacyTerm $privacyTerm */
        $privacyTerm = PrivacyTerm::find($privacyTermId);

        return view('promotion.terms.privacy-terms', [
            'promotion' => $promotion,
            'privacyTerm' => $privacyTerm,
        ]);
    }

}
