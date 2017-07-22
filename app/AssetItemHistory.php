<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    		default: // Other
    			$text = 'Other';
    			$status_class = 'badge-default'; 
    			# code...
    			break;
    	}

    	$html = '<h3 class="badge '.$status_class.'">'.$text.'</h3>';

    	return ['status'=>$status_class,'text'=>$text];
    }
}
