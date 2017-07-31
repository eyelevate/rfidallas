<?php

namespace App\Http\Controllers;

use App\Store;
use App\Job;
use Illuminate\Http\Request;

class StoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Store $store, Job $job)
    {
        $columns = $store->prepareTableColumns();
        $rows = $store->prepareTableRows($store->orderBy('name','asc')->get());
        $days = $job->prepareDays();
        return view('stores.index',compact(['columns','rows','days']));
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
        $hours = $job->prepareHours();
        $minutes = $job->prepareMinutes();
        $ampm = $job->prepareAmpm();
        $open = $job->prepareOpen();
        return view('stores.create',compact(['states','countries','hours','minutes','ampm','open']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Store $store)
    {
        
        
        //Validate the form
        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zipcode' => 'required|string|max:255',
        ]);
        $request->merge(['hours'=>json_encode($request->hours)]);
        $store->create($request->all());
        flash('Successfully created new store!')->success();
        return redirect()->route('stores_index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store, Job $job)
    {
        $store->hours = json_decode($store->hours);
        $states = $job->prepareStates();
        $countries = $job->prepareCountries();
        $hours = $job->prepareHours();
        $minutes = $job->prepareMinutes();
        $ampm = $job->prepareAmpm();
        $open = $job->prepareOpen();
        $days = $job->prepareDays();

        return view('stores.edit',compact(['states','countries','hours','minutes','ampm','open','store','days']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        //Validate the form
        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zipcode' => 'required|string|max:255',
        ]);
        $request->merge(['hours'=>json_encode($request->hours)]);
        $store->update($request->all());
        flash('Successfully updated store!')->success();
        return redirect()->route('stores_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        $delete = $store->delete();
        if ($delete) {
            flash('You have successfully deleted store.')->success();
            return redirect()->route('stores_index');
        }
    }
}
