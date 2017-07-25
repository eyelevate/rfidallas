<?php

namespace App\Http\Controllers;

use App\Asset;
use App\AssetItem;
use App\AssetItemHistory;
use App\Company;
use App\User;
use App\Vendor;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Auth;

class AssetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Asset $asset, Company $company, Vendor $vendor, AssetItem $assetItem)
    {
        $assets = $asset->prepareTableData($asset->all());
        $companies = $company->prepareCompanyForSelect($company->orderBy('name','asc')->get());
        $vendors = $vendor->prepareVendorForSelect($vendor->orderBy('name','asc')->get());
        $statuses = $assetItem->prepareStatusesForSelect();
        $columns = $assetItem->prepareTableColumns();

        return view('assets.index',compact(['assets','companies','vendors','statuses','columns']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assets.create');
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
            'desc' => 'required|string|max:255'
        ]);

        // Create and save the user.
        Asset::create(request()->all());

        // Redirect to the previous page.

        flash('You successfully created a new asset group.')->success();
        
        return redirect()->route('assets_index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function show(Asset $asset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function edit(Asset $asset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asset $asset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asset $asset)
    {
        //
    }

    public function issues(AssetItem $assetItem, User $user, AssetItemHistory $assetItemHistory)
    {
        $generated = $assetItem->where('status',3)->orderBy('id','desc')->get();
        $claimed = $assetItem->where('status',4)->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        $resolved = $assetItem->where('status',5)->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        $columns = $assetItem->prepareTableSelectColumns();
        $row_generated = $assetItem->prepareTableSelectRows($generated);
        $row_claimed = $assetItem->prepareTableSelectRows($claimed);
        $row_resolved = $assetItem->prepareTableSelectRows($resolved);
        $admin_columns = $user->prepareTableSelectColumns();
        $admin_rows = $user->prepareTableSelectRows($user->where('role_id','<',4)
            ->orderBy('last_name','asc')
            ->get());

        $resolutions = $assetItemHistory->prepareResolutionStatus();

        return view('assets.issues',compact(
            'generated',
            'claimed',
            'resolved',
            'columns',
            'row_generated',
            'row_claimed',
            'row_resolved',
            'admin_columns',
            'admin_rows',
            'resolutions')
        );
    }
}
