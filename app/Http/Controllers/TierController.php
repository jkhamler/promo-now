<?php

namespace App\Http\Controllers;

use App\Models\Tier;
use Illuminate\Http\Request;

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
            'level' => 'required',
            'shortDescription' => 'required',
            'longDescription' => 'required',
            'quantity' => 'required',
        ]);

        $tier = new Tier();

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
        ]);
    }

}
