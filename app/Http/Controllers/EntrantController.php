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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitEntryAction(Request $request)
    {

        $request->validate([
//            'urn' => 'string',
//            'email' => 'string|email',
//            'firstName' => 'string',
//            'surname' => 'string',
        ]);







        return redirect()->to("/entrants");


//        echo '<pre>';
//        echo print_r($request->all(), true);
//        echo '</pre>';
//        exit();
//

    }

    /**
     * @param Request $request
     */
    public function logSupportTicketAction(Request $request)
    {


    }

}
