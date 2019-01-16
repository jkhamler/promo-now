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
     * Valid URN
     *
     * @param $urnId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function validURNAction($urnId)
    {
        $urn = URN::find($urnId);

        return view('entrant.valid-urn', ['urn' => $urn]);
    }

    /**
     * Invalid URN
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function invalidURNAction()
    {
        return view('entrant.invalid-urn');
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
        $request->validate([
            'firstName' => 'string',
            'surname' => 'string',
            'emailAddress' => 'string',
            'issue' => 'string',
        ]);

        echo 'OK';
        exit;
    }


    /**
     * Submit URN
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitURNAction(Request $request)
    {
        $request->validate([
            'urnId' => 'string',
            'firstName' => 'string',
            'surname' => 'string',
            'emailAddress' => 'string',
        ]);

        /** @var Urn $urn */
        $urn = Urn::find($request->input('urnId'));

        if (!$urn->redeemed_at) {

            $person = Person::findByEmailAddress($request->input('emailAddress'));

            if (!$person) {

                $person = new Person();
                $person->first_name = $request->input('firstName');
                $person->surname = $request->input('surname');
                $person->email_address = $request->input('emailAddress');
                $person->save();
            }

            $entrant = new Entrant();
            $entrant->urn_id = $urn->id;
            $entrant->person_id = $person->id;
            $entrant->ip_address = $request->ip();
            $entrant->user_agent = $request->userAgent();

            $entrant->save();

            $urn->redeemed_at = new \DateTime();
            $urn->save();
        }

        return view('entrant.entry-summary');
    }


}
