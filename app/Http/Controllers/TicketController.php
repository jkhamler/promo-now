<?php

namespace App\Http\Controllers;

use Kordy\Ticketit\Controllers\TicketsController;

class TicketController extends TicketsController
{
    /**
     * Customer Services
     */
    public function customerServicesAction()
    {
        return view('ticket.customer-services');
    }

    /**
     * Fulfillment
     */
    public function fulfillmentAction()
    {
        return view('ticket.fulfillment');
    }


}
