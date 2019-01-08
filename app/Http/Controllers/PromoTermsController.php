<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PromoTermsController extends Controller
{
    /**
     * @param Request $request
     */
    public function createAction(Request $request)
    {
        echo '<pre>';
        echo print_r($request->all(), true);
        echo '</pre>';
        exit();

    }

    /**
     * @param $promotionId
     * @param Request $request
     */
    public function updateAction($promotionId, Request $request)
    {

    }
}
