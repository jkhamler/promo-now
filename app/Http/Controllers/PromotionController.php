<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Models\Tier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PromotionController extends Controller
{

    /**
     * Promotion Listing
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexAction()
    {
        $promotions = Promotion::all();

        return view('promotion.index', ['promotions' => $promotions]);
    }

    /**
     * Promotion Details
     *
     * @param $promotionId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detailsAction($promotionId)
    {
        $promotion = Promotion::find($promotionId);

        $tiers = Tier::all();

        return view('promotion.details', [
            'tiers' => $tiers,
            'promotion' => $promotion,
        ]);
    }

    /**
     * Create a promotion
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function createAction(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'promotionName' => 'required',
            'url' => 'required',
            'onlineDate' => 'required',
            'promoOpenDate' => 'required|date|after_or_equal:date:onlineDate',
            'promoClosedDate' => 'required|date|after:promoOpenDate',
            'offlineDate' => 'required|date|after_or_equal:date:promoClosedDate',
        ]);

        $promotion = new Promotion();

        $promotion->name = $data['promotionName'];
        $promotion->url = $data['url'];
        $promotion->description = $data['description'];
        $promotion->online_date = Carbon::parse($data['onlineDate']);
        $promotion->promo_open_date = Carbon::parse($data['promoOpenDate']);
        $promotion->promo_closed_date = Carbon::parse($data['promoClosedDate']);
        $promotion->offline_date = Carbon::parse($data['offlineDate']);
        if (isset($data['urnsRequired'])) {
            $promotion->urns_required = ($data['urnsRequired'] == 'on');
        }
        $promotion->urns_issued = $data['urnsIssued'] ?? 0;

        $promotion->save();

        return redirect()->to("/promotions/{$promotion->id}");
    }


    /**
     * Update the promotion
     *
     * @param $promotionId
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAction($promotionId, Request $request)
    {
        $data = $request->all();

        $request->validate([
            'promotionName' => 'required',
            'url' => 'required',
            'onlineDate' => 'required',
            'promoOpenDate' => 'required|date|after_or_equal:date:onlineDate',
            'promoClosedDate' => 'required|date|after:promoOpenDate',
            'offlineDate' => 'required|date|after_or_equal:date:promoClosedDate',
        ]);

        /** @var Promotion $promotion */
        $promotion = Promotion::find($promotionId);

        $promotion->name = $data['promotionName'];
        $promotion->url = $data['url'];
        $promotion->description = $data['description'];
        $promotion->online_date = Carbon::parse($data['onlineDate']);
        $promotion->promo_open_date = Carbon::parse($data['promoOpenDate']);
        $promotion->promo_closed_date = Carbon::parse($data['promoClosedDate']);
        $promotion->offline_date = Carbon::parse($data['offlineDate']);
        if (isset($data['urnsRequired'])) {
            $promotion->urns_required = ($data['urnsRequired'] == 'on');
        } else {
            $promotion->urns_required = false;
        }
        $promotion->urns_issued = $data['urnsIssued'];

        $promotion->save();

        return redirect()->to("/promotions/{$promotion->id}");

    }
}
