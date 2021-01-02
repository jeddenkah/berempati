<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Crowdfund;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuctionController extends Controller
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
        return view('admin.auction.create', compact('crowdfund'));
    }

    public function createUser($crowdfund_id)
    {
        $crowdfund = Crowdfund::find($crowdfund_id);
        return view('auction.create', compact('crowdfund'));
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
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'required | file | image',
            'start_nominal' => 'required|numeric',
            'target_date' => 'required|date',
        ]);
        $fileName = date("Y-m-d-His") . '_' . $request->file('image')->getClientOriginalName();

        $image = $request->file('image')
            ->storeAs('images/auction/', $fileName, ['disk'=>'public']);

        Auction::insert([
            'user_id' => Auth::user()->id,
            'crowdfund_id' => $crowdfund_id,
            'name' => $request->name,
            'desc' => $request->description,
            'image' => $fileName,
            'start_nominal' => $request->start_nominal,
            'target_date' => $request->target_date,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Toastr::success('Auction added successfully', 'Success!');
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
        $auction = Auction::find($id);

        return view('admin.auction.show', compact('auction'));
    }

    public function showUser($id){
        $auction = Auction::find($id);

        return view('auction.show', compact('auction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $auction = Auction::find($id);

        return view('admin.auction.edit', compact('auction'));
    }

    public function editUser($id)
    {
        $auction = Auction::find($id);

        return view('auction.edit', compact('auction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'file | image',
            'start_nominal' => 'required|numeric',
            'target_date' => 'required|date',
        ]);

        if ($request->hasFile('image')) {
            $existingImage = Auction::find($id)->image;
            Storage::disk('public')->delete('public/images/auction/' . $existingImage);


            $fileName = date("Y-m-d-His") . '_' . $request->file('image')->getClientOriginalName();
            $image = $request->file('image')
                ->storeAs('images/auction/', $fileName, ['disk'=>'public']);


            $image = Auction::find($id)->update([
                'image' => $fileName,
            ]);
        }

        $auction = Auction::find($id);
        $auction->update([
            'name' => $request->name,
            'desc' => $request->description,
            'start_nominal' => $request->start_nominal,
            'target_date' => $request->target_date,
            'updated_at' => Carbon::now()
        ]);

        Toastr::success('Auction edited successfully', 'Success!');
        return redirect()->route('crowdfund.show', $auction->crowdfund->id);

    }

    public function updateUser(Request $request, $id)
    {
        $validatedData = $request->validate([
            'description' => 'required|string',
            'image' => 'file | image',
            'start_nominal' => 'required|numeric',
            'target_date' => 'required|date',
        ]);

        if ($request->hasFile('image')) {
            $existingImage = Auction::find($id)->image;
            Storage::disk('public')->delete('public/images/auction/' . $existingImage);


            $fileName = date("Y-m-d-His") . '_' . $request->file('image')->getClientOriginalName();
            $image = $request->file('image')
                ->storeAs('images/auction/', $fileName, ['disk'=>'public']);


            $image = Auction::find($id)->update([
                'image' => $fileName,
            ]);
        }

        $auction = Auction::find($id);
        $auction->update([
            'desc' => $request->description,
            'start_nominal' => $request->start_nominal,
            'target_date' => $request->target_date,
            'updated_at' => Carbon::now()
        ]);

        Toastr::success('Auction edited successfully', 'Success!');
        return redirect()->route('user.profile');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $crowdfund_id = Auction::find($id)->crowdfund->id;

        $bids = Auction::find($id)->bids;
        foreach($bids as $bid){
            $bid->delete();
        }
        $existingImage = Auction::find($id)->image;

        Storage::disk('public')->delete('images/auction/' . $existingImage);

        Auction::where('id', $id)->delete();

        Toastr::success('Auction deleted successfully', 'Success!');
        return redirect()->route('crowdfund.show', $crowdfund_id);
    }
}
