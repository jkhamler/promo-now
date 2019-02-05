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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function gdprQuizAction()
    {
        $questions =
            [
                'What would you do?' => [
                    'Something 1',
                    'Something 2',
                    'Something 3',
                    'Something 4',
                ],
                'What would you do 2?' => [
                    'Something 5',
                    'Something 6',
                    'Something 7',
                    'Something 8',
                ],
                'What would you do 3?' => [
                    'Something 9',
                    'Something 10',
                    'Something 11',
                    'Something 12',
                ],
                'What would you do 4?' => [
                    'Something 13',
                    'Something 14',
                    'Something 15',
                    'Something 16',
                ],
            ];

        return view('gdpr-quiz', [
            'questions' => $questions
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function submitGdprQuizAction(Request $request)
    {
        return view('service-request-made', [
        ]);
    }

}
