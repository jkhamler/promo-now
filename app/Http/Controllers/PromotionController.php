<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexAction()
    {
        $promotions = Promotion::all();

        return view('promotion.index', ['promotions' => $promotions]);
    }

    /**
     * @param $promotionId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detailsAction($promotionId)
    {
        $promotion = Promotion::find($promotionId);

        return view('promotion.details', ['promotion' => $promotion]);
    }

    /**
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
            'promoOpenDate' => 'required|date|after:online_date',
        ]);

        $promotion = new Promotion();

        $promotion->name = $data['promotionName'];
        $promotion->url = $data['url'];
        $promotion->description = $data['description'];
        $promotion->online_date = Carbon::parse($data['onlineDate']);
        $promotion->promo_open_date = Carbon::parse($data['promoOpenDate']);
        $promotion->promo_closed_date = Carbon::parse($data['promoClosedDate']);
        $promotion->offline_date = Carbon::parse($data['offlineDate']);
        $promotion->urns_required = $data['urnsRequired'] ?? false;
        $promotion->urns_issued = $data['urnsIssued'];

        $promotion->save();

        return redirect()->to("/promotions/{$promotion->id}");
    }


    /**
     * @param $promotionId
     * @param Request $request
     */
    public function updateAction($promotionId, Request $request)
    {
        //
    }
}
