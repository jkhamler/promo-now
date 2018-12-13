<?php

namespace App\Http\Controllers;

use App\Models\Tier;
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
        ]);
    }

}
