<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Crowdfund;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $donation = Donation::all();
        $total_user = User::count();
        $total_crowdfund = Crowdfund::count();
        $total_auction = Auction::count();
        return view('admin.dashboard', compact('donation', 'total_user', 'total_crowdfund', 'total_auction'));
    }

    
}
