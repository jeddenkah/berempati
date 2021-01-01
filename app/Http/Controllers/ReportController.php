<?php

namespace App\Http\Controllers;

use App\Models\Crowdfund;
use App\Models\Report;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
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
        return view('admin.report.create', compact('crowdfund'));
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
            'description' => 'required|string',
            'image' => 'required | file | image',
            'datetime' => 'required',
        ]);

        $fileName = date("Y-m-d-His") . '_' . $request->file('image')->getClientOriginalName();

        $image = $request->file('image')
            ->storeAs('public/images/report/', $fileName);

        Report::insert([
            'user_id' => Auth::user()->id,
            'crowdfund_id' => $crowdfund_id,
            'image' => $fileName,
            'desc' => $request->description,
            'datetime' => $request->datetime,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            
        ]);

        Toastr::success('Report added successfully', 'Success!');
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
        $crowdfund = Crowdfund::find($crowdfund_id);
        $report = Report::find($id);

        return view('admin.report.edit', compact('crowdfund','report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $crowdfund_id, $id)
    {
        $validatedData = $request->validate([
            'description' => 'required|string',
            'image' => 'nullable | file | image',
            'datetime' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $existingImage = Report::find($id)->image;
            Storage::delete('public/images/report/' . $existingImage);


            $fileName = date("Y-m-d-His") . '_' . $request->file('image')->getClientOriginalName();
            $image = $request->file('image')
                ->storeAs('public/images/report/', $fileName);


            $image = Report::find($id)->update([
                'image' => $fileName,
            ]);
        }

        Report::find($id)->update([
            'desc' => $request->description,
            'datetime' => $request->datetime,
            'updated_at' => Carbon::now()
        ]);

        Toastr::success('Report edited successfully', 'Success!');
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
        $existingImage = Report::find($id)->image;

        Storage::delete('public/images/report/' . $existingImage);

        Report::where('id', $id)->delete();

        Toastr::success('Report deleted successfully', 'Success!');
        return redirect()->route('crowdfund.show', $crowdfund_id);
    }
}
