<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Tier;
use App\Models\TierItem;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TierController extends Controller
{
    /**
     * Create a tier
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function createAction(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'promotion_id' => 'required',
            'level' => Rule::unique('tiers')->where(function (Builder $query) use ($data) {
                return $query
                    ->where('level', $data['level'])
                    ->where('promotion_id', $data['promotion_id']);
            }),
            'shortDescription' => 'required',
            'longDescription' => 'required',
            'quantity' => 'required',
        ]);


        $tier = new Tier();

        $tier->promotion_id = $data['promotion_id'];
        $tier->level = $data['level'];
        $tier->short_description = $data['shortDescription'];
        $tier->long_description = $data['longDescription'];
        $tier->quantity = $data['quantity'];

        $tier->save();

        return redirect()->to("/tiers/{$tier->id}");
    }

    /**
     * Tier Details
     *
     * @param $tierId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detailsAction($tierId)
    {
        $tier = Tier::find($tierId);

        return view('tier.details', [
            'tier' => $tier,
            'partners' => Partner::all(),
        ]);
    }

    /**
     * @param $tierId
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAction($tierId, Request $request)
    {
        $data = $request->all();

        /** @var Tier $tier */
        $tier = Tier::find($tierId);

        $promotionId = $tier->promotion_id;

        $existingLevel = $tier->level;

        $request->validate([
            'shortDescription' => 'required',
            'longDescription' => 'required',
            'quantity' => 'required',
        ]);

        if ($existingLevel != $request['level']) {
            $request->validate(['level' => Rule::unique('tiers')->where(function (Builder $query) use ($data, $promotionId) {
                return $query
                    ->where('level', $data['level'])
                    ->where('promotion_id', $promotionId);
            })]);
        }

        $tier->level = $data['level'];
        $tier->short_description = $data['shortDescription'];
        $tier->long_description = $data['longDescription'];
        $tier->quantity = $data['quantity'];

        $tier->save();

        return redirect()->to("/tiers/{$tier->id}");

    }

    /**
     * Tier Item Details
     *
     * @param $tierItemId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tierItemDetailsAction($tierItemId)
    {
        $tierItem = TierItem::find($tierItemId);

        return view('tier.item.details', [
            'tierItem' => $tierItem,
            'partners' => Partner::all(),
        ]);
    }

    /**
     * Update a tier item
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function createTierItemAction(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'tier_id' => 'required',
            'shortDescription' => 'required',
            'longDescription' => 'required',
            'quantity' => 'required',
            'couponNumber' => 'required',
            'partnerId' => 'required',
        ]);

        $tierItem = new TierItem();

        $tierItem->tier_id = $data['tier_id'];
        $tierItem->short_description = $data['shortDescription'];
        $tierItem->long_description = $data['longDescription'];
        $tierItem->quantity = $data['quantity'];
        $tierItem->coupon_number = $data['couponNumber'];
        $tierItem->partner_id = $data['partnerId'];

        $tierItem->save();

        return redirect()->to("/tiers/{$tierItem->tier_id}");
    }

    /**
     * Update a tier item
     *
     * @param integer $tierItemId
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function updateTierItemAction($tierItemId, Request $request)
    {
        $data = $request->all();

        $request->validate([
            'shortDescription' => 'required',
            'longDescription' => 'required',
            'quantity' => 'required',
            'couponNumber' => 'required',
            'partnerId' => 'required',
        ]);

        /** @var TierItem $tierItem */
        $tierItem = TierItem::find($tierItemId);

        $tierItem->short_description = $data['shortDescription'];
        $tierItem->long_description = $data['longDescription'];
        $tierItem->quantity = $data['quantity'];
        $tierItem->coupon_number = $data['couponNumber'];
        $tierItem->partner_id = $data['partnerId'];

        $tierItem->save();

        return redirect()->to("/tiers/items/{$tierItem->id}");
    }

}
