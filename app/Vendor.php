<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'nick_name',
        'street',
        'city',
        'state',
        'country',
        'zipcode',
        'suite', 
        'phone',
        'contact_name',
        'contact_option',
        'email'
    ];

    public function assetItems()
    {
        // companies may have many devices
        // one device may be applied to one company
        return $this->hasMany(AssetItem::class);
    }

    public function prepareVendorForSelect($data)
    {
        $select = [''=>'Select Vendor From List'];
        if (count($data) > 0)
        {
            foreach ($data as $key => $value) {
                $full_name = isset($value->nick_name) ? $value->name.' ('.$value->nick_name.')' : $value->name;
                $select[$value->id] = $full_name;
            }
        }
        return $select;
    }



    public function prepareTableColumns()
    {

        $columns =  [
            [
                'label'=>'ID',
                'field'=> 'id',
                'filterable'=> true
            ], [
                'label'=>'Name',
                'field'=> 'full_name',
                'filterable'=> true
            ], [
                'label'=>'Address',
                'field'=> 'full_address',
                'filterable'=> true
            ], [
                'label'=>'Phone',
                'field'=> 'phone',
                'filterable'=> true
            ], [
                'label'=>'Contact',
                'field'=> 'contact_name',
                'filterable'=> true
            ], [
                'label'=>'Notes',
                'field'=> 'contact_option',
                'filterable'=> true
            ], [
                'label'=>'Created',
                'field'=> 'created_at',
                'type'=>'date',
                'inputFormat'=> 'YYYY-MM-DD HH:MM:SS',
                'outputFormat'=> 'MM/DD/YY hh:mm:ssa'
            ], [
                'label'=>'Updated',
                'field'=> 'updated_at',
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
        

        // check if exists
        if (isset($rows)) {
            foreach ($rows as $key => $value) {
            	$name = $value->name;
            	$nick_name = $value->nick_name;
            	$street = $value->street;
            	$suite = $value->suite;
            	$city = $value->city;
            	$country = $value->country;
            	$state = $value->state;
            	$zipcode = $value->zipcode;
            	// create full name here
            	$rows[$key]['full_name'] = (empty((array)$nick_name) || is_null($nick_name)) ? $name : $name.' ('.$nick_name.')';

            	// create address column here
            	$full_address = $street.' '.$suite.' '.$city.', '.$state.' '.$country.' '.$zipcode;

            	if(empty((array)$suite) || is_null($suite)) {
            		$full_address = $street.' '.$city.', '.$state.' '.$country.' '.$zipcode;
            	}

            	$rows[$key]['full_address'] = $full_address;


                // append last column to table here
                $last_column = '<a class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#viewModal-'.$value->id.'" href="#">View</a>';
                $last_column .= '</div>';
                $rows[$key]['action'] = $last_column;
            }
        }

        return $rows;
    }
}
