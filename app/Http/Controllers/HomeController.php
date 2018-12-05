<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function homeAction()
    {
        return view('home', ['name' => 'James']);
    }

}
