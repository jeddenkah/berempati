<?php

namespace App\Http\Controllers;

use App\Models\Crowdfund;
use App\Models\Donation;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
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
    public function create($crowdfund_id)
    {
        $crowdfund = Crowdfund::find($crowdfund_id);
        return view('admin.donation.create', compact('crowdfund'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($crowdfund_id, Request $request)
    {
        $validatedData = $request->validate([
            'nominal' => 'required|numeric',
            'message' => 'nullable|string',
        ]);
        $is_anonym = $request->is_anonym ?? false;

        Donation::insert([
            'user_id' => Auth::user()->id,
            'crowdfund_id' => $crowdfund_id,
            'nominal' => $request->nominal,
            'message' => $request->message,
            'is_anonym' => $is_anonym,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        Toastr::success('Donation added successfully', 'Success!');
        if(Auth::user()->role->name == 'admin'){
            return redirect()->route('crowdfund.show', $crowdfund_id);
        }else{
            return redirect()->route('crowdfund.showUser', $crowdfund_id);
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
    public function edit($crowdfund_id, $id)
    {
        $donation = Donation::find($id);
        $crowdfund = Crowdfund::find($crowdfund_id);
        return view('admin.donation.edit', compact('donation', 'crowdfund'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $crowdfund_id,  $id)
    {
        $validatedData = $request->validate([
            'nominal' => 'required|numeric',
            'message' => 'nullable|string',
        ]);

        $is_anonym = $request->is_anonym ?? false;

        Donation::find($id)->update([
            'nominal' => $request->nominal,
            'message' => $request->message,
            'is_anonym' => $is_anonym,
            'updated_at' => Carbon::now()
        ]);


        Toastr::success('Donation edited successfully', 'Success!');
        return redirect()->route('crowdfund.show', $crowdfund_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($crowdfund_id, $id)
    {
        Donation::find($id)->delete();

        Toastr::success('Donation deleted successfully', 'Success!');
        return redirect()->route('crowdfund.show', $crowdfund_id);
    }
}
