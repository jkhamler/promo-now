<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use App\Models\Promotion;
use App\Models\TierItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MechanicController extends Controller
{
    /**
     * Mechanic Listing
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexAction()
    {
        $mechanics = Mechanic::all();

        return view('mechanic.index', ['mechanics' => $mechanics]);
    }

    /**
     * Create a mechanic
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function createAction(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'type' => 'required',
            'promotion_id' => 'required',
        ]);

        $promotionId = $data['promotion_id'];

        $mechanic = new Mechanic();

        $mechanic->name = $data['name'];
        $mechanic->description = $data['description'];
        $mechanic->type = $data['type'];
        $mechanic->promotion_id = $data['promotion_id'];

        $mechanic->save();

        return redirect()->to("/promotions/{$promotionId}/mechanics/{$mechanic->id}");
    }

    /**
     * Mechanic Details
     *
     * @param $promotionId
     * @param $mechanicId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detailsAction($promotionId, $mechanicId)
    {
        /** @var Promotion $promotion */
        $promotion = Promotion::find($promotionId);

        /** @var TierItem[] $tierItems */
        $tierItems = $promotion->getAllPossibleTierItems();

        $mechanic = Mechanic::find($mechanicId);

        return view('mechanic.details', [
            'mechanic' => $mechanic,
            'tierItems' => $tierItems,
        ]);
    }

    /**
     * Update the mechanic
     *
     * @param $mechanicId
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAction($mechanicId, Request $request)
    {
        $data = $request->all();

        $request->validate([ // todo - clean this up.
//            'name' => 'string',
//            'description' => 'string',
//            'startDateTime' => 'date',
//            'endDateTime' => 'date',
//            'isOpen' => 'boolean',
//            'isRecyclable' => 'boolean',
//            'claimWindowDurationSeconds' => 'numeric',
//            'claimWindowDeadline' => 'date',
//            'piToGenerateMoments' => 'boolean',
//            'momentDurationSeconds' => 'integer',
//            'momentDistributionInterval' => 'integer',
//            'tierItemId' => 'integer',
//            'urnSpecificationId' => 'integer',
        ]);

        /** @var Mechanic $mechanic */
        $mechanic = Mechanic::find($mechanicId);

        if (isset($data['name'])) {
            $mechanic->name = $data['name'];
        }
        if (isset($data['description'])) {
            $mechanic->description = $data['description'];
        }

        if (isset($data['startDateTime'])) {
            $mechanic->start_datetime = Carbon::parse($data['startDateTime']);
        }
        if (isset($data['endDateTime'])) {
            $mechanic->end_datetime = Carbon::parse($data['endDateTime']);
        }
        if (isset($data['isOpen'])) {
            $mechanic->is_open = ($data['isOpen'] == 'on');
        } else {
            $mechanic->is_open = false;
        }
        if (isset($data['isRecyclable'])) {
            $mechanic->is_recyclable = ($data['isRecyclable'] == 'on');
        } else {
            $mechanic->is_recyclable = false;
        }
        if (isset($data['claimWindowDurationSeconds'])) {
            $mechanic->claim_window_duration_seconds = $data['claimWindowDurationSeconds'];
        }
        if (isset($data['claimWindowDeadline'])) {
            $mechanic->claim_window_deadline = Carbon::parse($data['claimWindowDeadline']);
        }
        if (isset($data['piToGenerateMoments'])) {
            $mechanic->pi_to_generate_moments = ($data['piToGenerateMoments'] == 'on');
        } else {
            $mechanic->pi_to_generate_moments = false;
        }
        if (isset($data['momentDurationSeconds'])) {
            $mechanic->moment_duration_seconds = $data['momentDurationSeconds'];
        }
        if (isset($data['momentDistributionInterval'])) {
            $mechanic->moment_distribution_interval_seconds = $data['momentDistributionInterval'];
        }
        if (isset($data['tierItemId'])) {
            if ($data['tierItemId'] == 0) {
                $mechanic->tier_item_id = null;
            } else {
                $mechanic->tier_item_id = $data['tierItemId'];
            }
        }
        if (isset($data['urnSpecificationId'])) {
            if ($data['urnSpecificationId'] == 0) {
                $mechanic->urn_specification_id = null;
            } else {
                $mechanic->urn_specification_id = $data['urnSpecificationId'];
            }
        }
        $mechanic->save();

        return redirect()->to("/promotions/{$mechanic->promotion_id}/mechanics/{$mechanic->id}");
    }
}
