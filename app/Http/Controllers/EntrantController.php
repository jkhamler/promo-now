<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntrantController extends Controller
{
    /**
     * Mechanic Listing
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexAction()
    {
        return view('entrant.index');
    }

    /**
     * @param Request $request
     */
    public function submitEntryAction(Request $request)
    {

    }

    /**
     * @param Request $request
     */
    public function logSupportTicketAction(Request $request)
    {


    }

}
