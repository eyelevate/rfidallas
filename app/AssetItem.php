<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AssetItem extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'name',
        'desc',
        'model',
        'serial',
        'price',
        'status',
        'reason',
        'vendor_id',
        'asset_id'
    ];

    public function assets() 
    {
    	return $this->belongsTo(Asset::class,'asset_id','id');
    }

    public function company()
    {
    	return $this->belongsTo(Company::class);
    }

    public function vendor()
    {
    	return $this->belongsTo(Vendor::class);
    }

    public function assetItemHistory()
    {
        return $this->hasMany(AssetItemHistory::class);
    }

    public function prepareStatusesForSelect()
    {
    	return [
    		'1' => 'Available',
    		'2' => 'Deployed To Company',
    		'3' => 'Issue Assigned',
    		'4' => 'Issue Claimed',
    		'5' => 'Issue Resolved',
    		'6' => 'Returned to Vendor',
    		'7' => 'Other'
    	];
    }

    public function prepareTableColumns()
    {

        $columns =  [
            [
                'label'=>'Name',
                'field'=> 'name',
                'filterable'=> true
            ], [
                'label'=>'Vendor',
                'field'=> 'vendor_name',
                'filterable'=> true
            ], [
                'label'=>'Company',
                'field'=> 'company_name',
                'filterable'=> true
            ], [
                'label'=>'Model',
                'field'=> 'model',
                'filterable'=> true
            ], [
                'label'=>'Serial',
                'field'=> 'serial',
                'filterable'=> true
            ], [
                'label'=>'Status',
                'field'=> 'status_html',
                'html'=>true
            ], [
                'label'=>'Created',
                'field'=> 'created_at',
                'type'=>'date',
                'inputFormat'=> 'YYYY-MM-DD HH:MM:SS',
                'outputFormat'=> 'MM/DD/YY hh:mm:ssa'
            ], [
                'label'=>'Action',
                'field'=> 'action',
                'html'=>true
            ]
        ];

        return json_encode($columns);
    }

    public function prepareTableRows($rows)
    {
        
    	$statuses = $this->prepareStatusesForSelect();
        // check if exists
        if (isset($rows)) {
            foreach ($rows as $key => $value) {

            	$rows[$key]['vendor_name'] =  isset($value->vendor->name) ? $value->vendor->name : 'No Vendor';
            	$rows[$key]['company_name'] = isset($value->company->name) ? $value->company->name : 'No Company';

            	// statuses
            	switch ($value->status) {
            		case 1: // Available
            			$status_class = 'badge-success';
            			break;

            		case 2: // Deployed To Company
            			$status_class = 'badge-primary'; 
            			break;

            		case 6: // Retuned to Vendor
            			$status_class = 'badge-danger'; 
            			break;
            		case 7: // Other
            			$status_class = 'badge-default'; 
            			break;
            		
            		default:
            			$status_class = 'badge-warning';
            			break;
            	}
            	$rows[$key]['status_html'] = '<span class="badge '.$status_class.'">'.$statuses[$value->status].'</span>';

            	


                // append last column to table here
                $last_column = '<a class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#viewModal-'.$value->id.'" href="#">View</a>';
                $last_column .= '</div>';
                $rows[$key]['action'] = $last_column;
            }
        }

        return $rows;
    }
}
