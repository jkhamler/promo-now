<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;

class MechanicController extends Controller
{
    /**
     * Mechanic Listing
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexAction()
    {
        $mechanics = Mechanic::all();

        return view('mechanic.index', ['mechanics' => $mechanics]);
    }
}
