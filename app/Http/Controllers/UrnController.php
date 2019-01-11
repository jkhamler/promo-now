<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Promotion;
use App\Models\UrnBatch;
use App\Models\UrnSpecification;
use Illuminate\Http\Request;

class UrnController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createUrnSpecificationAction(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'promotionId' => 'required',
            'referenceId' => 'required',
            'purpose' => 'required',
            'length' => 'required',
        ]);

        $promotionId = $data['promotionId'];

        $urnSpecification = new UrnSpecification();

        $urnSpecification->promotion_id = $promotionId;
        $urnSpecification->reference_id = $data['referenceId'];
        $urnSpecification->purpose = $data['purpose'];
        $urnSpecification->length = $data['length'];

        $urnSpecification->save();

        return redirect()->to("/promotions/{$promotionId}/urn-specifications/{$urnSpecification->id}");
    }

    /**
     * @param $promotionId
     * @param $urnSpecificationId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function urnSpecificationDetailsAction($promotionId, $urnSpecificationId)
    {
        /** @var Promotion $promotion */
        $promotion = Promotion::find($promotionId);

        /** @var UrnSpecification $urnSpecification */
        $urnSpecification = UrnSpecification::find($urnSpecificationId);

        return view('urn.specification.details', [
            'promotion' => $promotion,
            'urnSpecification' => $urnSpecification,
            'urnSpecificationPurposes' => UrnSpecification::PURPOSES,
            'languages' => Language::all(),
        ]);
    }

    /**
     * Update the URN Specification
     *
     * @param $urnSpecificationId
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUrnSpecificationAction($urnSpecificationId, Request $request)
    {
        $data = $request->all();

        $request->validate([ // todo - clean this up.
//            'referenceId' => 'string',
//            'purpose' => 'string',
//            'length' => 'string',
//            'includedChars' => 'string',
//            'regexExclude' => 'string',
//            'profanityCheckLanguageId' => 'string',
//            'urnQuantity' => 'string',
//            'winningUrnQuantity' => 'string',
//            'piToGenerate' => 'string',
//            'everyoneGets' => 'string',
//            'allocatedByTier' => 'string',
        ]);

        /** @var UrnSpecification $urnSpecification */
        $urnSpecification = UrnSpecification::find($urnSpecificationId);

        if (isset($data['referenceId'])) {
            $urnSpecification->reference_id = $data['referenceId'];
        }
        if (isset($data['purpose'])) {
            $urnSpecification->purpose = $data['purpose'];
        }
        if (isset($data['length'])) {
            $urnSpecification->length = $data['length'];
        }
        if (isset($data['includedChars'])) {
            $urnSpecification->included_characters = $data['includedChars'];
        }
        if (isset($data['regexExclude'])) {
            $urnSpecification->regex_exclude = $data['regexExclude'];
        }
        if (isset($data['profanityCheckLanguageId'])) {
            $urnSpecification->profanity_check_language_id =
                $data['profanityCheckLanguageId'] == '0' ? null : $data['profanityCheckLanguageId'];
        }
        if (isset($data['urnQuantity'])) {
            $urnSpecification->urn_quantity = $data['urnQuantity'];
        }
        if (isset($data['winningUrnQuantity'])) {
            $urnSpecification->winning_urn_quantity = $data['winningUrnQuantity'];
        }
        if (isset($data['piToGenerate'])) {
            $urnSpecification->pi_to_generate = ($data['piToGenerate'] == 'on');
        } else {
            $urnSpecification->pi_to_generate = false;
        }
        if (isset($data['everyoneGets'])) {
            $urnSpecification->everyone_gets = ($data['everyoneGets'] == 'on');
        } else {
            $urnSpecification->everyone_gets = false;
        }
        if (isset($data['allocatedByTier'])) {
            $urnSpecification->allocated_by_tier = ($data['allocatedByTier'] == 'on');
        } else {
            $urnSpecification->allocated_by_tier = false;
        }
        $urnSpecification->save();

        return redirect()->to("/promotions/{$urnSpecification->promotion_id}/urn-specifications/{$urnSpecification->id}");
    }

    /**
     * @param $urnSpecificationId
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function generateUrnBatchAction ($urnSpecificationId, Request $request)
    {
        $data = $request->all();

        $request->validate([ // todo - clean this up.
        ]);

        /** @var UrnSpecification $urnSpecification */
        $urnSpecification = UrnSpecification::find($urnSpecificationId);

        $urnBatch = $urnSpecification->generateUrnBatch($data['batchName']);

        return redirect()->to("/promotions/{$urnSpecification->promotion_id}/urn-specifications/{$urnSpecification->id}");
    }


}
