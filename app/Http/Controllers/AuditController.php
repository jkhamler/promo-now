<?php

namespace App\Http\Controllers;

use OwenIt\Auditing\Models\Audit;

class AuditController extends Controller
{
    /**
     *
     */
    public function indexAction()
    {
        $audits = Audit::all()->sortByDesc("created_at");

        return view('audit.index', ['audits' => $audits]);
    }


}
