<?php

namespace App\Http\Controllers;

use App\Models\Entrant;
use App\Models\EntrantTierStockItem;
use App\Models\Mechanic;
use App\Models\Person;
use App\Models\Promotion;
use App\Models\Urn;
use Illuminate\Http\Request;
use Kordy\Ticketit\Models\Setting;
use Kordy\Ticketit\Models\Ticket;

class EntrantController extends Controller
{
    /**
     * Entrant Entry Point (Enter URN)
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function enterPromoCodeAction()
    {
        /** @var Promotion $promotion */
        $promotion = Promotion::find(1); // hard coded for demo purposes

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function supportTicketAction()
    {
        /** @var Promotion $promotion */
        $promotion = Promotion::find(1); // hard coded for demo purposes

        return view('entrant.log-support-ticket', ['promotion' => $promotion]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logSupportTicketAction(Request $request)
    {
        $request->validate([
            'promotionId' => 'integer',
            'firstName' => 'string',
            'surname' => 'string',
            'emailAddress' => 'string',
            'subject' => 'string',
            'enquiry' => 'string',
        ]);

        $person = Person::findByEmailAddress($request->input('emailAddress'));

        if (!$person) {

            $person = new Person();
            $person->first_name = $request->input('firstName');
            $person->surname = $request->input('surname');
            $person->email_address = $request->input('emailAddress');
            $person->save();
        }

        /** @var Promotion $promotion */
        $promotion = Promotion::find($request->input('promotionId'));

        // search/create person record
        // Set up TicketIt ticket with category 'Customer Support' (send notification)

        $priorityId = 2; // todo
        $categoryId = 3; // todo

        $ticketContent = <<<EOT
Promotion: {$promotion->name}

Entrant: {$person->name} - {$person->email_address}

Subject: {$request->subject}

Enquiry: {$request->enquiry}
        
bar
EOT;

        $ticket = new Ticket();

        $ticket->subject = $request->subject;

        $ticket->setPurifiedContent($ticketContent);

        $ticket->priority_id = $priorityId;
        $ticket->category_id = $categoryId;

        $ticket->status_id = Setting::grab('default_status_id');
        $ticket->user_id = auth()->user()->id;
        $ticket->autoSelectAgent();

        $ticket->save();

        session()->flash('status', trans('ticketit::lang.the-ticket-has-been-created'));

        return redirect()->to("/test-promo/support-ticket-logged/{$person->id}");
    }

    /**
     * @param $personId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function supportTicketLoggedAction($personId)
    {
        /** @var Person $person */
        $person = Person::find($personId);

        return view('entrant.support-ticket-logged', ['person' => $person]);
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
            $entrant->promotion_id = $promotion->id;
            $entrant->ip_address = $request->ip();
            $entrant->user_agent = $request->userAgent();

            $entrant->save();

            $urn->redeemed_at = new \DateTime();
            $urn->save();

            /** @var Mechanic $primaryMechanic */
            $primaryMechanic = $promotion->mechanics->first();

            if ($primaryMechanic->type == Mechanic::MECHANIC_TYPE_EVERYBODY_GETS
                && $primaryMechanic->tier_item_id) {

                // automatically assign the tier item
                $entrantTierItem = new EntrantTierStockItem();
                $entrantTierItem->entrant_id = $entrant->id;
                $entrantTierItem->tier_item_id = $primaryMechanic->tier_item_id;
                $entrantTierItem->save();
            }
        }

        return view('entrant.entry-summary', [
            'promotion' => $promotion,
            'person' => $person ?? null,
        ]);
    }


}
