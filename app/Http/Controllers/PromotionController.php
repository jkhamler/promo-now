<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
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
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function createAction(Request $request)
    {

        $promotion = new Promotion();

        $params = $request->all();

        $promotion->name = $params['promotionName'];
        $promotion->url = $params['url'];
        $promotion->description = $params['description'];
        $promotion->online_date = $params['onlineDate'];
        $promotion->promo_open_date = $params['promoOpenDate'];
        $promotion->promo_closed_date = $params['promoClosedDate'];
        $promotion->offline_date = $params['offlineDate'];
        $promotion->urns_issued = $params['urnsIssued'];

        $promotion->save();

        return redirect()->to('/promotions');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
