<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Kordy\Ticketit\Models\Setting;
use Kordy\Ticketit\Models\Ticket;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function requestServicesAction()
    {
        return view('request-services', [
            'promotions' => Promotion::all()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function makeServiceRequestAction(Request $request)
    {
        $request->validate([
            'promotionId' => 'integer',
            'subject' => 'string',
            'enquiry' => 'string',
        ]);

        $promotionId = $request->input('promotionId');

        /** @var Promotion $promotion */
        $promotion = Promotion::find($promotionId);

        /** Create Technical Ticket */
        $technicalCategory = DB::table('ticketit_categories AS tc')
            ->select('tc.id AS id')
            ->where('tc.name', 'Technical')
            ->first();

        $normalPriority = DB::table('ticketit_priorities AS tp')
            ->select('tp.id AS id')
            ->where('tp.name', 'Normal')
            ->first();

        $ticketContent = <<<EOT
Promotion: {$promotion->name}

Subject: {$request->input('subject')}

Enquiry: {$request->input('enquiry')};
        
EOT;

        $ticket = new Ticket();

        $ticket->subject = $request->input('subject');
        $ticket->setPurifiedContent($ticketContent);
        $ticket->priority_id = $normalPriority->id;
        $ticket->category_id = $technicalCategory->id;

        $ticket->status_id = Setting::grab('default_status_id');
        $ticket->user_id = Auth::id();

        $ticket->autoSelectAgent();

        $ticket->save();

        session()->flash('status', trans('ticketit::lang.the-ticket-has-been-created'));

        return view('service-request-made', [
        ]);
    }

}
