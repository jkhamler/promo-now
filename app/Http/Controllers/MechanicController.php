<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
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
     * @param $mechanicId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detailsAction($mechanicId)
    {
        /** @var Mechanic $mechanic */
        $mechanic = Mechanic::find($mechanicId);

        return view('mechanic.details', [
            'mechanic' => $mechanic,
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

        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        /** @var Mechanic $mechanic */
        $mechanic = Mechanic::find($mechanicId);

        $mechanic->name = $data['name'];
        $mechanic->description = $data['description'];
        $mechanic->save();

        return view('mechanic.details', [
            'mechanic' => $mechanic,
        ]);

    }


}
