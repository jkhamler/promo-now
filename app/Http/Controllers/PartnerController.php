<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{

    /**
     * Partner Listing
     */
    public function indexAction()
    {
        $partners = Partner::all();

        return view('partner.index', ['partners' => $partners]);
    }

    /**
     * @param $partnerId
     */
    public function detailsAction($partnerId)
    {


    }

    /**
     * @param Request $request
     */
    public function createAction(Request $request)
    {


    }

    /**
     * @param $partnerId
     * @param Request $request
     */
    public function updateAction($partnerId, Request $request)
    {


    }

}
