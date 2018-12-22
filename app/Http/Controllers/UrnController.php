<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
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

        $urnSpecification = UrnSpecification::find($urnSpecificationId);

        return view('urn.specification.details', [
            'promotion' => $promotion,
            'urnSpecification' => $urnSpecification,
        ]);
    }


}
