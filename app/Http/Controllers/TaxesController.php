<?php

namespace App\Http\Controllers;

use App\Tax;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TaxesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tax $tax)
    {
        $current= Tax::latest()->first();
        $history = Tax::orderBy('id','desc')->get();
        return view('taxes.index',compact(['current','history']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('taxes.create');
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
            'rate' => 'required|numeric'
        ]);

        // Create and save the user.
        Tax::create(request()->all());

        // Redirect to the previous page.

        flash('You successfully updated the tax rate.')->success();
        
        return redirect()->route('taxes_index');
    }


}
