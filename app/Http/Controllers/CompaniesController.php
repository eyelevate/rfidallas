<?php

namespace App\Http\Controllers;

use App\Company;
use App\Job;
use App\Plan;
use App\User;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Company $company)
    {
        $columns = $company->prepareTableColumns();
        $rows = $company->prepareTableRows($company->orderBy('name','asc')->get());
        return view('companies.index',compact(['columns','rows']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Job $job, User $user)
    {
        $states = $job->prepareStates();
        $countries = $job->prepareCountries();
        $columns = $user->prepareTableSelectColumns();
        $rows = $user->prepareTableSelectRows($user->where('role_id',4)->orderBy('last_name')->get());
        return view('companies.create',compact(['states','countries','columns','rows']));
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
            'user_display' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
        ]);

        // Create and save the user.
        Company::create(request()->all());

        // Redirect to the previous page.
        flash('You successfully created a new company!')->success();
        return redirect()->route('companies_index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company, Job $job, User $user, Plan $plan)
    {
        $states = $job->prepareStates();
        $countries = $job->prepareCountries();
        $columns = $user->prepareTableSelectColumns();
        $rows = $user->prepareTableSelectRows($user->where('role_id',4)->orderBy('last_name')->get());
        $plan_columns = $plan->prepareTableSelectColumns();
        $plan_rows = $plan->prepareTableSelectRows($plan->orderBy('name','asc')->get());
        return view('companies.edit',compact('company','states','countries','columns','rows','plan_columns','plan_rows'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        if ($company->delete()) {
            flash('Successfully deleted company from database.')->success();
            return redirect()->route('companies_index');
        }
    }
}
