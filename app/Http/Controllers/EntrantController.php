<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Country;
use App\Models\Entrant;
use App\Models\EntrantTierItemStock;
use App\Models\Mechanic;
use App\Models\Person;
use App\Models\PersonAddress;
use App\Models\Promotion;
use App\Models\TierItem;
use App\Models\TierItemStock;
use App\Models\Urn;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Kordy\Ticketit\Models\Setting;
use Kordy\Ticketit\Models\Ticket;

class EntrantController extends Controller
{

    /**
     * @param $promotionId
     * @param $entrantId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detailsAction($promotionId, $entrantId)
    {
        /** @var Entrant $entrant */
        $entrant = Entrant::find($entrantId);

        return view('entrant.details', ['entrant' => $entrant]);
    }


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

        return view('entrant.valid-urn', [
            'urn' => $urn,
            'countries' => Country::all(),
        ]);
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
        $existingUser = Auth::user();

        $request->validate([
            'promotionId' => 'integer',
            'firstName' => 'string',
            'surname' => 'string',
            'emailAddress' => 'string',
            'subject' => 'string',
            'enquiry' => 'string',
        ]);

        $normalPriority = DB::table('ticketit_priorities AS tp')
            ->select('tp.id AS id')
            ->where('tp.name', 'Normal')
            ->first();

        $supportCategory = DB::table('ticketit_categories AS tc')
            ->select('tc.id AS id')
            ->where('tc.name', 'Helpdesk')
            ->first();

        $supportUserId = DB::table('ticketit_categories_users AS tcu')
            ->select('tcu.user_id AS user_id')
            ->where('tcu.category_id', $supportCategory->id)
            ->first();

        /** @var User $supportUser */
        $supportUser = User::find($supportUserId->user_id);

        Auth::login($supportUser);

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

        $priorityId = $normalPriority->id;
        $categoryId = $supportCategory->id;

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

        $ticket->user_id = Auth::id();

        $ticket->autoSelectAgent();

        $ticket->save();

        session()->flash('status', trans('ticketit::lang.the-ticket-has-been-created'));

        Auth::logout();

        if ($existingUser) {
            Auth::login($existingUser);
        }

        return redirect()->to(route('supportTicketLogged', [$person->id]));
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function gdprRequestAction()
    {
        return view('entrant.gdpr-request');
    }

    public function logGdprRequestAction(Request $request)

    {
        $existingUser = Auth::user();

        $request->validate([
            'firstName' => 'string',
            'surname' => 'string',
            'emailAddress' => 'string',
            'subject' => 'string',
        ]);

        $criticalPriority = DB::table('ticketit_priorities AS tp')
            ->select('tp.id AS id')
            ->where('tp.name', 'Critical')
            ->first();

        $gdprCategory = DB::table('ticketit_categories AS tc')
            ->select('tc.id AS id')
            ->where('tc.name', 'GDPR')
            ->first();

        $superAdminUserId = DB::table('ticketit_categories_users AS tcu')
            ->select('tcu.user_id AS user_id')
            ->where('tcu.category_id', $gdprCategory->id)
            ->first();

        /** @var User $superAdminUser */
        $superAdminUser = User::find($superAdminUserId->user_id);

        Auth::login($superAdminUser);

        $person = Person::findByEmailAddress($request->input('emailAddress'));

        if (!$person) {

            $person = new Person();
            $person->first_name = $request->input('firstName');
            $person->surname = $request->input('surname');
            $person->email_address = $request->input('emailAddress');
            $person->save();
        }

        $priorityId = $criticalPriority->id;
        $categoryId = $gdprCategory->id;

        $ticketContent = <<<EOT
<h4>GDPR REQUEST!!</h4>

Entrant: {$person->name} - {$person->email_address}

Subject: GDPR Request

Enquiry: {$request->enquiry}
        
bar
EOT;
        $ticket = new Ticket();

        $ticket->subject = 'Urgent GDPR Request';

        $ticket->setPurifiedContent($ticketContent);

        $ticket->priority_id = $priorityId;
        $ticket->category_id = $categoryId;

        $ticket->status_id = Setting::grab('default_status_id');

        $ticket->user_id = Auth::id();

        $ticket->autoSelectAgent();

        $ticket->save();

        session()->flash('status', trans('ticketit::lang.the-ticket-has-been-created'));

        Auth::logout();

        if ($existingUser) {
            Auth::login($existingUser);
        }

        return redirect()->to(route('supportTicketLogged', [$person->id]));
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

        /** @var Mechanic $primaryMechanic */
        $primaryMechanic = $promotion->mechanics->first();

        if ($primaryMechanic->type == Mechanic::MECHANIC_TYPE_EVERYBODY_GETS
            && $primaryMechanic->tier_item_id) {

            /** @var TierItem $tierItem */
            $tierItem = $primaryMechanic->tierItem;

        }

        if ($promotion->urns()->contains($urnModel)) {
            return view('entrant.valid-urn', [
                'tierItem' => $tierItem ?? null,
                'urn' => $urnModel,
                'promotion' => $promotion,
                'countries' => Country::all(),

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
            'addressLine1' => 'string',
            'addressLine2' => 'string',
            'addressLine3' => 'string',
            'city' => 'string',
            'state' => 'string',
            'postcode' => 'string',
            'countryId' => 'integer',
        ]);

        $existingUser = Auth::user();

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

            $address = new Address();
            $address->address_line_1 = $request->input('addressLine1');
            $address->address_line_2 = $request->input('addressLine2');
//            $address->address_line_3 = $request->input('addressLine3');
            $address->city = $request->input('city');
            $address->state = $request->input('state');
            $address->postcode = $request->input('postcode');
            $address->country_id = $request->input('countryId');
            $address->save();

            $personAddress = new PersonAddress();
            $personAddress->person_id = $person->id;
            $personAddress->address_id = $address->id;
            $personAddress->save();

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

                /** @var TierItem $tierItem */
                $tierItem = $primaryMechanic->tierItem;

                /** @var TierItemStock $firstStockItem */
                $firstStockItem = $tierItem->unallocatedStock->first();
                $firstStockItem->allocated_datetime = new \DateTime();
                $firstStockItem->save();

                // automatically assign the tier item
                $entrantTierItem = new EntrantTierItemStock();
                $entrantTierItem->entrant_id = $entrant->id;
                $entrantTierItem->tier_item_stock_id = $firstStockItem->id;
                $entrantTierItem->save();

                /** Create Fulfillment Ticket */
                $fulfillmentCategory = DB::table('ticketit_categories AS tc')
                    ->select('tc.id AS id')
                    ->where('tc.name', 'F&H')
                    ->first();

                $fulfillmentUserId = DB::table('ticketit_categories_users AS tcu')
                    ->select('tcu.user_id AS user_id')
                    ->where('tcu.category_id', $fulfillmentCategory->id)
                    ->first();

                $normalPriority = DB::table('ticketit_priorities AS tp')
                    ->select('tp.id AS id')
                    ->where('tp.name', 'Normal')
                    ->first();

                $ticketContent = <<<EOT
Promotion: {$promotion->name}

Entrant: {$person->name} - {$person->email_address}

Tier Item: {$tierItem->short_description}

Reference Number: {$firstStockItem->reference_number};
        
EOT;
            }

            /** @var User $fulfillmentUser */
            $fulfillmentUser = User::find($fulfillmentUserId->user_id);

            Auth::logout();
            Auth::login($fulfillmentUser);

            $ticket = new Ticket();

            $ticket->subject = 'New Order';
            $ticket->setPurifiedContent($ticketContent);
            $ticket->priority_id = $normalPriority->id;
            $ticket->category_id = $fulfillmentCategory->id;

            $ticket->status_id = Setting::grab('default_status_id');
            $ticket->user_id = $fulfillmentUserId->user_id;

            $ticket->autoSelectAgent();

            $ticket->save();

            session()->flash('status', trans('ticketit::lang.the-ticket-has-been-created'));

            if ($existingUser) {
                Auth::login($existingUser);
            }

        }

        return view('entrant.entry-summary', [
            'promotion' => $promotion,
            'person' => $person ?? null,
        ]);
    }


}
