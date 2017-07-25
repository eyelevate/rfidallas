<?php

namespace App\Http\Controllers;

use App\Fee;
use App\Plan;
use App\Service;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Plan $plan)
    {
        $columns = $plan->prepareTableColumns();
        $rows = $plan->prepareTableRows($plan->orderBy('name','asc')->get());
        return view('plans.index',compact(['columns','rows']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Plan $plan, Fee $fee, Service $service)
    {
        $fee_columns = $fee->prepareTableSelectColumns();
        $fee_rows = $fee->prepareTableSelectRows($fee->orderBy('name','asc')->get());
        $service_columns = $service->prepareTableSelectColumns();
        $service_rows = $service->prepareTableSelectRows($service->orderBy('name','asc')->get());
        return view('plans.create',compact(['fee_columns','fee_rows','service_columns','service_rows']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        //
    }
}
