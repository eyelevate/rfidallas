<?php

namespace App\Http\Controllers;

use App\Asset;
use App\AssetItem;
use App\AssetItemHistory;
use App\Company;
use App\Vendor;
use Auth;
use Illuminate\Http\Request;

class AssetItemsController extends Controller
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
    public function create(Asset $asset, Company $company, Vendor $vendor, AssetItem $assetItem)
    {
        $assets = $asset->prepareAssetForSelect($asset->orderBy('name','asc')->get());
        $companies = $company->prepareCompanyForSelect($company->orderBy('name','asc')->get());
        $vendors = $vendor->prepareVendorForSelect($vendor->orderBy('name','asc')->get());
        $statuses = $assetItem->prepareStatusesForSelect();
        return view('asset_items.create',compact(['assets','companies','vendors','statuses']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,AssetItemHistory $assetItemHistory)
    {
        //Validate the form
        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'asset_id'=>'required',
            'vendor_id'=>'required',
            'model'=>'required|string|max:255',
            'serial'=>'required|string|max:255',
            'price' => 'required|numeric'
        ]);


        // Create and save.
        $save = AssetItem::create(request()->all());
        if ($save) {
            // Create first row of asset item history for this new asset item
            $assetItemHistory->asset_item_id = $save->id;
            $assetItemHistory->type=1; // new product available for deployment
            $assetItemHistory->user_id = Auth::user()->id;
            $assetItemHistory->detail = 'Product registered as a new asset';
            $assetItemHistory->status = 1; // good to go
            if ($assetItemHistory->save()){
                 // Redirect to the previous page.

                flash('You successfully created a new asset item. We are now tracking the history of this item!')->success();
                
                return redirect()->route('assets_index');
            }

        }
        

       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AssetItem  $assetItem
     * @return \Illuminate\Http\Response
     */
    public function show(AssetItem $assetItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AssetItem  $assetItem
     * @return \Illuminate\Http\Response
     */
    public function edit(AssetItem $assetItem,Asset $asset, Company $company, Vendor $vendor)
    {
        $assets = $asset->prepareAssetForSelect($asset->orderBy('name','asc')->get());
        $companies = $company->prepareCompanyForSelect($company->orderBy('name','asc')->get());
        $vendors = $vendor->prepareVendorForSelect($vendor->orderBy('name','asc')->get());
        $statuses = $assetItem->prepareStatusesForSelect();
        return view('asset_items.edit',compact(['assetItem','companies','vendors','statuses','assets']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AssetItem  $assetItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssetItem $assetItem)
    {
        //Validate the form
        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'asset_id'=>'required',
            'vendor_id'=>'required',
            'model'=>'required|string|max:255',
            'serial'=>'required|string|max:255',
            'price' => 'required|numeric',
            'status'=>'required'
        ]);
        flash('Successfully updated asset item!')->success();
        $assetItem->update(request()->all());
        return redirect()->route('assets_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AssetItem  $assetItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssetItem $assetItem)
    {
        if($assetItem->delete()) {
            flash('You have deleted '.$assetItem->name.' from your asset group!')->success();
            return redirect()->back();
        }
    }


    public function deploy(AssetItem $assetItem)
    {
        return view('asset_items.deploy',compact(['assetItem']));
    }

    public function updateDeploy(Request $request, AssetItem $assetItem)
    {

    }

    public function return(AssetItem $assetItem)
    {
        return view('asset_items.return',compact(['assetItem']));
    }

    public function updateReturn(Request $request, AssetItem $assetItem)
    {

    }

}
