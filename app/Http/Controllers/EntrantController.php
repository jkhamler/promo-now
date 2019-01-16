<?php

namespace App\Http\Controllers;

use App\Models\Entrant;
use App\Models\Person;
use App\Models\Urn;
use Illuminate\Http\Request;

class EntrantController extends Controller
{
    /**
     * Entrant Entry Point (Enter URN)
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function enterPromoCodeAction()
    {
        return view('entrant.enter-promo-code');
    }

    /**
     * Log Support Ticket
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function supportTicketAction()
    {
        return view('entrant.log-support-ticket');
    }

    /**
     * @param Request $request
     */
    public function logSupportTicketAction(Request $request)
    {


    }

    /**
     * Invalid Entry Code
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function invalidEntryCodeAction()
    {
        return view('entrant.invalid-entry-code');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitEntryAction(Request $request)
    {

        $request->validate([
//            'urn' => 'string',
//            'emailAddress' => 'string|email',
//            'firstName' => 'string',
//            'surname' => 'string',
        ]);

        $urn = Urn::findByUrn($request->input('urn'));

        if (!$urn) {
            return redirect()->to("/entrants/invalid-entry-code");
        } else {

            $existingPersonForEmailAddress = Person::findByEmailAddress($request->input('emailAddress'));

            if ($existingPersonForEmailAddress) {

                $personId = $existingPersonForEmailAddress->id;

            } else {

                $person = new Person();
                $person->first_name = $request->input('firstName');
                $person->surname = $request->input('surname');
                $person->email_address = $request->input('emailAddress');
                $person->save();

                $personId = $person->id;
            }


            $entrant = new Entrant();
            $entrant->person_id = $personId;
            $entrant->urn_id = $urn->id;


        }


    }


}
