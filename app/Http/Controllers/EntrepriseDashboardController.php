<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntrepriseDashboardController extends Controller
{
    public function index()
    {
        // Your controller logic here
        return view('entreprise.dashboard'); // Make sure this view exists
    }
    public function __construct()
{
    $this->middleware('entreprise');
}
}
