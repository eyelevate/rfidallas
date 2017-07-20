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
                $last_column = '<div class="btn-group" role="group">';
                $last_column .= '<button id="btnGroupDrop-'.$value->id.'" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Options</button>';
                $last_column .= '<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">';
                $last_column .= '<a class="dropdown-item" href="'.route('vendors_edit',$value->id).'">Edit</a>';
                $last_column .= '<a class="dropdown-item text-danger" data-toggle="modal" data-target="#deleteModal-'.$value->id.'" href="#" style="z-index:9999;">Delete</a>';
                $last_column .= '</div></div>';
                $rows[$key]['action'] = $last_column;
            }
        }

        return $rows;
    }
}
