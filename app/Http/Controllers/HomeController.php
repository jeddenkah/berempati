<?php

namespace App\Http\Controllers;

use App\Models\Crowdfund;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $crowdfunds = Crowdfund::all();
        return view('welcome', compact('crowdfunds'));
    }
}
