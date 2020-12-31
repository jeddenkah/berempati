<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($auction_id)
    {
        $auction = Auction::find($auction_id);
        return view('admin.bid.create', compact('auction'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($auction_id, Request $request)
    {
        $validatedData = $request->validate([
            'nominal' => 'required|numeric',
            'desc' => 'nullable|string',
        ]);

        Bid::insert([
            'user_id' => Auth::user()->id,
            'auction_id' => $auction_id,
            'nominal'=> $request->nominal, 
            'desc'=> $request->desc, 
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Toastr::success('Bid added successfully', 'Success!');
        if(Auth::user()->role->name == 'admin'){
            return redirect()->route('auction.show', $auction_id);
        }else{
            return redirect()->route('auction.showUser', $auction_id);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($auction_id, $id)
    {
        $bid = Bid::find($id);

        return view('admin.bid.edit', compact('bid'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $auction_id, $id)
    {
        $validatedData = $request->validate([
            'nominal' => 'required|numeric',
            'desc' => 'nullable|string',
        ]);

        Bid::find($id)->update([
            'nominal'=> $request->nominal, 
            'desc'=> $request->desc, 
            'updated_at' => Carbon::now()
        ]);

        Toastr::success('Bid edited successfully', 'Success!');
        return redirect()->route('auction.show', $auction_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($auction_id, $id)
    {
        Bid::find($id)->delete();

        Toastr::success('Bid deleted successfully', 'Success!');
        return redirect()->route('auction.show', $auction_id);
    }
}
