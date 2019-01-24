<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Tier;
use App\Models\TierItem;
use App\Models\TierItemStock;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TierController extends Controller
{
    /**
     * Create a tier
     *
     * @param $promotionId
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createAction($promotionId, Request $request)
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

        return redirect()->to(route('tierDetails', [$promotionId, $tier->id]));
    }

    /**
     * Tier Details
     *
     * @param $promotionId
     * @param $tierId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detailsAction($promotionId, $tierId)
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

        return redirect()->to(route('tierDetails', [$promotionId, $tier->id]));
    }

    /**
     * Tier Item Details
     *
     * @param $promotionId
     * @param $tierId
     * @param $tierItemId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tierItemDetailsAction($promotionId, $tierId, $tierItemId)
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
     * @param $promotionId
     * @param $tierId
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createTierItemAction($promotionId, $tierId, Request $request)
    {
        $data = $request->all();

        $request->validate([
            'tier_id' => 'required',
            'shortDescription' => 'required',
            'longDescription' => 'required',
            'couponNumber' => 'required',
            'partnerId' => 'required',
            'quantity' => 'required',
        ]);

        $tierItem = new TierItem();

        $tierItem->tier_id = $data['tier_id'];
        $tierItem->short_description = $data['shortDescription'];
        $tierItem->long_description = $data['longDescription'];
        $tierItem->coupon_number = $data['couponNumber'];
        $tierItem->partner_id = $data['partnerId'];
        $tierItem->quantity = $data['quantity'];

        $tierItem->save();

        return redirect()->to(route('tierItemDetails', [$promotionId, $tierId, $tierItem->id]));
    }

    /**
     * Update a tier item
     *
     * @param $promotionId
     * @param $tierId
     * @param $tierItemId
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateTierItemAction($promotionId, $tierId, $tierItemId, Request $request)
    {
        $data = $request->all();

        $request->validate([
            'partnerId' => 'required',
            'shortDescription' => 'required',
            'longDescription' => 'required',
            'couponNumber' => 'required',
            'quantity' => 'required',
        ]);

        /** @var TierItem $tierItem */
        $tierItem = TierItem::find($tierItemId);

        $tierItem->short_description = $data['shortDescription'];
        $tierItem->long_description = $data['longDescription'];
        $tierItem->coupon_number = $data['couponNumber'];
        $tierItem->partner_id = $data['partnerId'];
        $tierItem->quantity = $data['quantity'];

        $tierItem->save();

        return redirect()->to(route('tierItemDetails', [$promotionId, $tierId, $tierItem->id]));
    }

    /**
     * @param $tierItemStockId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tierItemStockDetailsAction($tierItemStockId)
    {
        $tierItemStock = TierItemStock::find($tierItemStockId);

        return view('tier.item.stock.details', [
            'tierItemStock' => $tierItemStock,
        ]);

    }

    /**
     * @param $tierItemStockId
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateTierItemStockAction($tierItemStockId, Request $request)
    {
        $data = $request->all();

        $request->validate([
            'referenceNumber' => 'required',
        ]);

        /** @var TierItemStock $tierItemStock */
        $tierItemStock = TierItemStock::find($tierItemStockId);

        $tierItemStock->reference_number = $data['referenceNumber'];

        $tierItemStock->save();

        return view('tier.item.stock.details', [
            'tierItemStock' => $tierItemStock,
        ]);
    }


}
