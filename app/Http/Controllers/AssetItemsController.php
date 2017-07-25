<?php

namespace App\Http\Controllers;

use App\Asset;
use App\AssetItem;
use App\AssetItemHistory;
use App\Company;
use App\User;
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
    public function update(Request $request, AssetItem $assetItem, AssetItemHistory $assetItemHistory)
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
            if ($assetItemHistory->newHistory($old_assetItem, $assetItem, 9)) {
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

    public function claimed(Request $request,AssetItem $assetItem, AssetItemHistory $assetItemHistory)
    {
        $status = 4;
        $user_id = $request->id; 
        $user = User::find($user_id);
        $user_full = ucFirst($user->first_name).' '.ucFirst($user->last_name).' ('.$user->email.')';
        $assigned_to = 'Assigned issue to '.$user_full;
        $old_assetItem = AssetItem::find($assetItem->id);

        $update = $assetItem->update([
            'status'=>$status,
            'user_id'=>$user_id
        ]);


        if ($update) {
            if ($assetItemHistory->newHistory($old_assetItem, $assetItem, $status)) {
                flash('Successfully assigned issue to '.$user_full.'!')->success();
                return redirect()->back();
            }   
        }

    }

    public function resolved(Request $request, AssetItem $assetItem, AssetItemHistory $assetItemHistory)
    {
        $status = ($request->reason_status == 1) ? 5 : 4;
        $old_assetItem = AssetItem::find($assetItem->id);
        $update = $assetItem->update([
            'status'=>$status
        ]);

        $resolutions = $assetItemHistory->prepareResolutionStatus();
        $description = $resolutions[$request->reason_status].' - '.$request->detail;

        if ($update) {
            if ($assetItemHistory->newHistorySimple($assetItem, $status, $description)) {
                flash('Successfully updated asset issue!')->success();
                return redirect()->back();
            }   
        }
    }
    public function complete(Request $request, AssetItem $assetItem, AssetItemHistory $assetItemHistory)
    {
        $status = $request->status;
        $old_assetItem = AssetItem::find($assetItem->id);
        $update = $assetItem->update([
            'status'=>$status
        ]);
        switch ($status) {
            case 1:
                $description = 'Asset has been returned back to us.';
                break;
            case 2:
                $description = 'Asset issue resolved and re-deployed back to customer.';
                break;
            case 6:
                $description = 'Asset sent back to vendor for refund/repair.';
                break;
            
            default:
                $description = '';
                break;
        }

        if ($update) {
            if ($assetItemHistory->newHistorySimple($assetItem, $status, $description)) {
                flash('Successfully updated asset issue!')->success();
                return redirect()->back();
            }   
        }
    }

}
