<?php

namespace App\Http\Controllers;

use App\Fee;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Fee $fee)
    {
        $columns = $fee->prepareTableColumns();
        $rows = $fee->prepareTableRows($fee->all());
        
        return view('fees.index', compact(['columns','rows']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate the form
        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'desc' => 'required|string|max:255',
            'pretax' => 'required|numeric'
        ]);

        // Create and save the user.
        Fee::create(request()->all());

        // Redirect to the previous page.

        flash('You successfully created a new fee.')->success();
        
        return redirect()->route('fees_index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function show(Fee $fee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function edit(Fee $fee)
    {
        return view('fees.edit',compact('fee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fee $fee)
    {
        //Validate the form
        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'desc' => 'required|string|max:255',
            'pretax' => 'required|numeric'
        ]);
        flash('Successfully updated fee!')->success();
        $fee->update(request()->all());
        return redirect()->route('fees_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fee $fee)
    {
        if($fee->delete()) 
        {
            flash('You have successfully deleted a fee.')->success();
            return redirect()->route('fees_index');
        }
    }

    public function retrieve(Request $request, Fee $fee)
    {
        $fees = $fee->find($request->fee_id);

        return response()->json($fees);
    }

    public function totals(Request $request, Fee $fee)
    {
        $fee_ids = [];
        $fees = $request->fees;
        if (count($fees) > 0 ){
            foreach ($fees as $fee) {
                array_push($fee_ids, $fee->id);
            }
        }

        $sum = $fee->whereIn('id',$fee_ids)->sum('pretax');

        return response()->json($sum);
    }
}
