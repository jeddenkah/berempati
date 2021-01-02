<?php

namespace App\Http\Controllers;

use App\Models\Auction;
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
        $auctions = Auction::all();
        return view('welcome', compact('crowdfunds', 'auctions'));
    }

    public function search(Request $request){
        $search = $request->search_query;

        $crowdfunds = Crowdfund::where('name', 'like', '%'.$search.'%')->get();
        // $crowdfunds = Crowdfund::all();
        $auctions = Auction::where('name', 'like', '%'.$search.'%')->get();
        // $auctions = Auction::take(1)->get();

        return view('result', compact('crowdfunds', 'auctions', 'search'));
    }
}
