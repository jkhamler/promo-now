<?php

namespace App\Http\Controllers;

use App\Models\Entrant;
use App\Models\Person;
use App\Models\Promotion;
use App\Models\Urn;
use Illuminate\Http\Request;

class EntrantController extends Controller
{
    /**
     * Entrant Entry Point (Enter URN)
     *
     * @param $promotionId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function enterPromoCodeAction($promotionId)
    {
        /** @var Promotion $promotion */
        $promotion = Promotion::find($promotionId);

        return view('entrant.enter-promo-code', ['promotion' => $promotion]);
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
     * @param $promotionId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function supportTicketAction($promotionId)
    {
        /** @var Promotion $promotion */
        $promotion = Promotion::find($promotionId);

        return view('entrant.log-support-ticket', ['promotion' => $promotion]);
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


    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function submitURNAction(Request $request)
    {
        $request->validate([
            'promotionId' => 'integer',
            'urn' => 'string',
        ]);

        /** @var Promotion $promotion */
        $promotion = Promotion::find($request->input('promotionId'));

        $urn = $request->input('urn');
        $urnModel = Urn::findByUrn($urn);

        if ($promotion->urns()->contains($urnModel)) {
            return view('entrant.valid-urn', [
                'urn' => $urnModel,
                'promotion' => $promotion,
            ]);
        } else {
            return view('entrant.invalid-urn');
        }
    }

    /**
     * Submit Validated URN
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitValidatedURNAction(Request $request)
    {
        $request->validate([
            'urnId' => 'integer',
            'promotionId' => 'integer',
            'firstName' => 'string',
            'surname' => 'string',
            'emailAddress' => 'string',
        ]);

        /** @var Urn $urn */
        $urn = Urn::find($request->input('urnId'));

        /** @var Promotion $promotion */
        $promotion = Promotion::find($request->input('promotionId'));

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

        return view('entrant.entry-summary', [
            'promotion' => $promotion,
            'person' => $person ?? null,
        ]);
    }


}
