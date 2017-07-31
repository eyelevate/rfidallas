<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    //
    protected $fillable = [
        'name',
        'nick_name', 
        'street',
        'suite',
        'city', 
        'state',
        'country',
        'zipcode',
        'phone',
        'phone_option',
        'email',
        'hours',
        'status'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class,'store_user');   
    }

    public function plans() 
    {
        return $this->belongsTo(Plan::class,'plan_id','id');
    }

    public function prepareCompanyForSelect($data)
    {
        $select = [''=>'Select Company From List'];
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
                'label'=>'Name',
                'field'=> 'full_name',
                'filterable'=> true
            ], [
                'label'=>'Street',
                'field'=> 'full_address',
                'filterable'=> true
            ], [
                'label'=>'Phone',
                'field'=> 'phone',
                'filterable'=> true
            ], [
                'label'=>'Phone 2',
                'field'=> 'phone_option',
                'filterable'=> true
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

    public function prepareTableSelectColumns()
    {

        $columns =  [
            [
                'label'=>'Name',
                'field'=> 'full_name',
                'filterable'=> true
            ], [
                'label'=>'Street',
                'field'=> 'street',
                'filterable'=> true
            ], [
                'label'=>'Suite',
                'field'=> 'suite',
                'filterable'=> true
            ], [
                'label'=>'City',
                'field'=> 'city',
                'filterable'=> true
            ], [
                'label'=>'State',
                'field'=> 'state',
                'filterable'=> true
            ], [
                'label'=>'Zipcode',
                'field'=> 'zipcode',
                'filterable'=> true
            ], [
                'label'=>'Phone',
                'field'=> 'phone',
                'filterable'=> true
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
                // owner field
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

                $rows[$key]['hours'] = json_decode($value->hours);

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

    public function prepareTableSelectRows($rows)
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
                $last_column = '<button type="button" company-id="'.$value->id.'" class="select-company btn btn-success btn-sm">Select</button>';
                $last_column .= '</div>';
                $rows[$key]['action'] = $last_column;
            }
        }

        return $rows;
    }

    static public function countStores()
    {
    	return Store::count();
    }
}
