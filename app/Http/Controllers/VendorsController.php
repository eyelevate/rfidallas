<?php

namespace App\Http\Controllers;

use App\Job;
use App\Vendor;
use Illuminate\Http\Request;

class VendorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Vendor $vendor)
    {
        $columns = $vendor->prepareTableColumns();
        $rows = $vendor->prepareTableRows($vendor->all());
        
        return view('vendors.index', compact(['columns','rows']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Job $job)
    {
        $states = $job->prepareStates();
        $countries = $job->prepareCountries();
        return view('vendors.create',compact('states','countries'));
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
            'name' => 'required|string|max:255'
        ]);

        // Create and save the user.
        Vendor::create(request([
            'name',
            'nick_name',
            'street',
            'suite',
            'city',
            'state',
            'country',
            'zipcode',
            'phone',
            'email',
            'contact_name',
            'contact_option'])
        );

        // Redirect to the previous page.

        flash('You successfully created a new vendor.')->success();
        
        return redirect()->route('vendors_index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor, Job $job)
    {
        $states = $job->prepareStates();
        $countries = $job->prepareCountries();
        return view('vendors.edit',compact(['vendor','states','countries']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        //Validate the form
        $this->validate(request(), [
            'name' => 'required|string|max:255'
        ]);
        flash('Successfully updated vendor!')->success();
        $vendor->update(request()->all());
        return redirect()->route('vendors_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $vendor)
    {
        if($vendor->delete()) 
        {
            flash('You have successfully deleted a vendor.')->success();
            return redirect()->route('vendors_index');
        }
    }
}
