<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{

    /**
     * Partner Listing
     */
    public function indexAction()
    {
        $partners = Partner::all();

        return view('partner.index', ['partners' => $partners]);
    }

    /**
     * @param $partnerId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detailsAction($partnerId)
    {
        /** @var Partner $partner */
        $partner = Partner::find($partnerId);

        return view('partner.details', [
            'partner' => $partner,
        ]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createAction(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'partnerName' => 'string|required',
            'legalName' => 'string|nullable',
            'description' => 'string|nullable',
            'companyNumber' => 'string|nullable',]);

        $partner = new Partner();

        $partner->name = $data['partnerName'];
        $partner->legal_name = $data['legalName'];
        $partner->description = $data['description'];
        $partner->company_number = $data['companyNumber'];

        $partner->save();

        return redirect()->to(route('partnerDetails', [$partner->id]));
    }

    /**
     * @param $partnerId
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAction($partnerId, Request $request)
    {
        $data = $request->all();

        $request->validate([
            'partnerName' => 'string|required',
            'legalName' => 'string|nullable',
            'description' => 'string|nullable',
            'companyNumber' => 'string|nullable',
        ]);

        /** @var Partner $partner */
        $partner = Partner::find($partnerId);

        $partner->name = $data['partnerName'];
        $partner->legal_name = $data['legalName'];
        $partner->description = $data['description'];
        $partner->company_number = $data['companyNumber'];

        $partner->save();

        return redirect()->to(route('partnerDetails', [$partner->id]));
    }

}
