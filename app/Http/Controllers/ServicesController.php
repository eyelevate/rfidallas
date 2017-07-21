<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Service $service)
    {
        $columns = $service->prepareTableColumns();
        $rows = $service->prepareTableRows($service->all());
        
        return view('services.index', compact(['columns','rows']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create');
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
        Service::create(request()->all());

        // Redirect to the previous page.

        flash('You successfully created a new fee.')->success();
        
        return redirect()->route('services_index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('services.edit',compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //Validate the form
        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'desc' => 'required|string|max:255',
            'pretax' => 'required|numeric'
        ]);
        flash('Successfully updated service!')->success();
        $service->update(request()->all());
        return redirect()->route('services_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        if($service->delete()) 
        {
            flash('You have successfully deleted a service.')->success();
            return redirect()->route('services_index');
        }
    }
}
