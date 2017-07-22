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
        // Set old asset item before saving for comparison later on
        $old_assetItem = AssetItem::find($assetItem->id);

        // Check if user changed status back to 1 (Available) or 6 (Returned) ** refer to AssetItemHistory model
        if ($request->status == 1 || $request->status == 6)
        {
            // If returned or available then company ID must be NULL
            request()->company_id = NULL;
        }

        $update = $assetItem->update(request()->all());
        if ($update) {
            $assetItemHistory = new AssetItemHistory;
            $assetItemHistory->asset_item_id = $assetItem->id;
            $assetItemHistory->user_id = Auth::user()->id;
            $assetItemHistory->type = 9;
            $statuses = $assetItem->prepareStatusesForSelect();
        
            // Start details
            $detail = [];

            if ($old_assetItem->asset_id != $assetItem->asset_id) { // Check asset id 
                $asset = Asset::find($assetItem->asset_id);
                $new_asset_name = $asset->name;
                array_push($detail,[
                    'name'=>'Asset Group',
                    'old'=>'('.$old_assetItem->asset_id.') '.$old_assetItem->assets->name,
                    'new'=>'('.$assetItem->asset_id.') '.$new_asset_name]
                );
            }

            if ($old_assetItem->vendor_id != $assetItem->vendor_id) { // Check vendor id
                $vendor = Vendor::find($vendor->vendor_id);
                $new_vendor_name = $vendor->name;
                array_push($detail,[
                    'name'=>'Vendor',
                    'old'=>'('.$old_assetItem->vendor_id.') '.$old_assetItem->vendor->name,
                    'new'=>'('.$assetItem->vendor_id.') '.$new_vendor_name]
                );
            }
            
            if ($old_assetItem->company_id != $assetItem->company_id) { // Check company_id
                $old_company_name = (isset($old_assetItem->company_id)) ? $old_assetItem->company->name :  'None Set';
                $company = Company::find($assetItem->company_id);
                $new_company_name = (count($company) > 0) ? $company->name : 'None Set';
                array_push($detail,[
                    'name'=>'Company',
                    'old'=>'('.$old_assetItem->company_id.') '.$old_company_name,
                    'new'=>'('.$assetItem->company_id.') '.$new_company_name]
                );
            }

            if ($old_assetItem->name != $assetItem->name) { // CHeck name
                array_push($detail,[
                    'name'=>'Name',
                    'old'=>$old_assetItem->name,
                    'new'=>$assetItem->name]
                );
            }

            if ($old_assetItem->desc != $assetItem->desc) { // Description
                array_push($detail,[
                    'name'=>'Description',
                    'old'=>$old_assetItem->desc,
                    'new'=>$assetItem->desc]
                );
            }

            if ($old_assetItem->model != $assetItem->model) { // Model
                array_push($detail,[
                    'name'=>'Model',
                    'old'=>$old_assetItem->model,
                    'new'=>$assetItem->model]
                );
            }

            if ($old_assetItem->serial != $assetItem->serial) { // Serial
                array_push($detail,[
                    'name'=>'Serial',
                    'old'=>$old_assetItem->serial,
                    'new'=>$assetItem->serial]
                );
            }

            if ($old_assetItem->price != $assetItem->price) { // Price
                array_push($detail,[
                    'name'=>'Price',
                    'old'=>$old_assetItem->price,
                    'new'=>$assetItem->price]

                );
            }

            if ($old_assetItem->status != $assetItem->status) { // Status
                array_push($detail,[
                    'name'=>'Status',
                    'old'=>'('.$old_assetItem->status.') - '.$statuses[$old_assetItem->status],
                    'new'=>'('.$assetItem->status.') - '.$statuses[$assetItem->status]]

                );
            }

            if ($old_assetItem->reason != $assetItem->reason) { // Reason
                array_push($detail,[
                    'name'=>'Reason',
                    'old'=>$old_assetItem->reason,
                    'new'=>$assetItem->reason]
                );
            }
            $assetItemHistory->detail = json_encode($detail);
            $assetItemHistory->status = 1;

            if ($assetItemHistory->save()) {
                flash('Successfully updated asset item!')->success();
                return redirect()->route('assets_index');
            }

        }
        
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
