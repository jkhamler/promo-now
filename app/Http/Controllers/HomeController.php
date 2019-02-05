<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\User;
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
        $techCategory = DB::table('ticketit_categories AS tc')
            ->select('tc.id AS id')
            ->where('tc.name', 'Tech')
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
        $ticket->category_id = $techCategory->id;

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
        $request->validate([
            'question1' => 'string|nullable',
            'question2' => 'string|nullable',
            'question3' => 'string|nullable',
            'question4' => 'string|nullable',
            'textQuestion' => 'string|nullable',
            'checkboxAnswer1' => 'string|nullable',
            'checkboxAnswer2' => 'string|nullable',
            'checkboxAnswer3' => 'string|nullable',
        ]);

        /** @var User $user */
        $user = Auth::user();

//        echo '<pre>';
//        echo print_r($request->all(), true);
//        echo '</pre>';
//        exit();

        /** Create Technical Ticket */
        $gdprQuizCategory = DB::table('ticketit_categories AS tc')
            ->select('tc.id AS id')
            ->where('tc.name', 'GDPR Quiz')
            ->first();

        $normalPriority = DB::table('ticketit_priorities AS tp')
            ->select('tp.id AS id')
            ->where('tp.name', 'Normal')
            ->first();

        $ticketContent = <<<EOT
        
Quiz submission: {$user->getFullName()} (User ID {$user->id})<br/><br/>

Please review the answers and update the gdpr_verified_at and gdpr_expires_at date/time values accordingly.
<br/><br/>
Question 1: {$request->input('question1')}<br/>
Question 2: {$request->input('question2')}<br/>
Question 3: {$request->input('question3')}<br/>
Question 4: {$request->input('question4')}<br/>
Text Question: {$request->input('textQuestion')}<br/>
Checkbox Answer1: {$request->input('checkboxAnswer1')}<br/>
Checkbox Answer2: {$request->input('checkboxAnswer2')}<br/>
Checkbox Answer3: {$request->input('checkboxAnswer3')}<br/>

EOT;

        $ticket = new Ticket();

        $ticket->subject = "GDPR Quiz Submission - {$user->getFullName()} (User ID {$user->id})";
        $ticket->setPurifiedContent($ticketContent);
        $ticket->priority_id = $normalPriority->id;
        $ticket->category_id = $gdprQuizCategory->id;

        $ticket->status_id = Setting::grab('default_status_id');
        $ticket->user_id = Auth::id();

        $ticket->autoSelectAgent();

        $ticket->save();

        session()->flash('status', trans('ticketit::lang.the-ticket-has-been-created'));

        return view('service-request-made', [
        ]);
    }

}
