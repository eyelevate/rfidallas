<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use App\AssetItem;

class AssetItemHistory extends Model
{
    //
	use SoftDeletes;

	public function user()
	{
		return $this->belongsTo(User::class,'user_id','id');
	}

    public function assetItems()
    {
    	return $this->belongsTo(AssetItem::class,'asset_item_id','id');
    }


    /**
	* TYPES
	* 1 - Available
	* 2 - Deployed To Company
	* 3 - Issue Created By Member
	* 4 - Issue Claimed By Admin
	* 5 - Issue Resolved By Admin
	* 6 - Returned 
	* 7 - Other
	* 8 - New Asset Created 
	* 9 - Edited 
	* 10 - Deleted 
	**/

    public function convertTypeToText($type)
    {
    	$status_class = 'badge-warning';
    	switch ($type) {
    		case 1: // Available
    			$text = 'Available';
    			$status_class = 'badge-success';
    			break;
    		case 2: // deployed to company
    			$text = 'Deployed To Company';
    			$status_class = 'badge-primary'; 
    			break;
    		case 3: // Issue Assigned
    			$text = 'Issue Assigned';
    			
    			break;
    		case 4: // Issue Claimed
    			$text = 'Issue Claimed';
    			break;
    		case 5: // Issue Resolved
    			$text = 'Issue Resolved';
    			break;
    		case 6: // Returned to Vendor
    			$text = 'Returned to Vendor';
    			$status_class = 'badge-danger'; 
    			break;
    		case 8:
    			$text = 'New Assset Created';
    			$status_class = 'badge-info';
    			break;
    		case 9:
    			$text = 'Asset Info Edited';
    			break;
    		case 10:
    			$text = 'Asset Deleted';
    			$status_class = 'badge-danger';
    			break;
    		default: // Other
    			$text = 'Other';
    			$status_class = 'badge-default'; 
    			# code...
    			break;
    	}

    	$html = '<h3 class="badge '.$status_class.'">'.$text.'</h3>';

    	return ['status'=>$status_class,'text'=>$text];
    }

    public function newHistorySimple($assetItem, $status, $description)
    {
    	$assetItemHistory = new AssetItemHistory;
    	$assetItemHistory->asset_item_id = $assetItem->id;
    	$assetItemHistory->user_id = Auth::user()->id;
    	$assetItemHistory->type = $status;
    	$assetItemHistory->detail = $description;
    	$assetItemHistory->status = 1;
    	if ($assetItemHistory->save()) {
         	return true;   
        } 

        return false;

    }

    public function newHistory($old_assetItem, $assetItem, $type)
    {
    	$ai = new AssetItem;
    	$assetItemHistory = new AssetItemHistory;
    	$assetItemHistory->asset_item_id = $assetItem->id;
        $assetItemHistory->user_id = Auth::user()->id;
        $assetItemHistory->type = $type;

        $statuses = $ai->prepareStatusesForSelect();
    
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

        if ($old_assetItem->user_id != $assetItem->user_id) { //
            array_push($detail,[
                'name'=>'Reason',
                'old'=>$old_assetItem->reason,
                'new'=>$assetItem->reason]
            );
        }

        $assetItemHistory->detail = json_encode($detail);
        $assetItemHistory->status = 1;

        if ($assetItemHistory->save()) {
         	return true;   
        } 

        return false;
        
    }

    public function prepareResolutionStatus()
    {
    	return [
            '' => 'Select resolution reason',
            '1' => 'Success - resolved issue',
            '2' => 'Delayed - Unable to contact customer',
            '3' => 'Delayed - Unable to re-create issue for testing',
            '4' => 'Fail - Unable to fix issue',
            '5' => 'Returned - return item to vendor',
            '6' => 'Other'
        ];
    }
}
