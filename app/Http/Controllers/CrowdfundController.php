<?php

namespace App\Http\Controllers;

use App\Models\Crowdfund;
use Brian2694\Toastr\Facades\Toastr as Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CrowdfundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $crowdfunds = Crowdfund::all();
        return view('admin.crowdfund.index', compact('crowdfunds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.crowdfund.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'required | file | image',
            'target_nominal' => 'required|numeric',
            'target_date' => 'required|date',
        ]);


        $fileName = date("Y-m-d-His") . '_' . $request->file('image')->getClientOriginalName();

        $image = $request->file('image')
            ->storeAs('public/images/crowdfund/', $fileName);

        Crowdfund::insert([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'desc' => $request->description,
            'image' => $fileName,
            'target_nominal' => $request->target_nominal,
            'target_date' => $request->target_date,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Toastr::success('Crowdfund added successfully', 'Success!');
        return redirect()->route('crowdfund.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $crowdfund = Crowdfund::find($id);
        return view('admin.crowdfund.show', compact('crowdfund'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $crowdfund = Crowdfund::find($id);
        return view('admin.crowdfund.edit', compact('crowdfund'));
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
            'image' => 'nullable | file | image',
            'target_nominal' => 'required|numeric',
            'target_date' => 'required|date',
        ]);

        if ($request->hasFile('image')) {
            $existingImage = Crowdfund::find($id)->image;
            Storage::delete('public/images/crowdfund/' . $existingImage);


            $fileName = date("Y-m-d-His") . '_' . $request->file('image')->getClientOriginalName();
            $image = $request->file('image')
                ->storeAs('public/images/crowdfund/', $fileName);


            $image = Crowdfund::find($id)->update([
                'image' => $fileName,
            ]);
        }


        Crowdfund::find($id)->update([
            'name' => $request->name,
            'desc' => $request->description,
            'target_nominal' => $request->target_nominal,
            'target_date' => $request->target_date,
            'updated_at' => Carbon::now()
        ]);

        Toastr::success('Crowdfund edited successfully', 'Success!');
        return redirect()->route('crowdfund.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingImage = Crowdfund::find($id)->image;

        Storage::delete('public/images/crowdfund/' . $existingImage);

        Crowdfund::where('id', $id)->delete();

        Toastr::success('Crowdfund deleted successfully', 'Success!');
        return redirect()->route('crowdfund.index');
    }
}