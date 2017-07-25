<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'plan_id',
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
        'payment_gateway',
        'payment_api_key',
        'status'
    ];

    public function assetItems()
    {
    	// companies may have many devices
    	// one device may be applied to one company
    	return $this->belongsToMany(AssetItem::class);
    }

    public function users() 
    {
        return $this->belongsTo(User::class,'user_id','id');
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
                'label'=>'Owner',
                'field'=> 'owners',
                'html'=>true
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
                'label'=>'Email',
                'field'=> 'email',
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

    public function prepareTableRows($rows)
    {
        

        // check if exists
        if (isset($rows)) {
            foreach ($rows as $key => $value) {
                // owner field
                $users = $value->users;
                
                $owner = '<button data-toggle="modal" data-target="#ownerModal-'.$users->id.'" class="btn btn-link" href="#">'.$users->email.' <strong>('.$users->first_name.' '.$users->last_name.')</strong></button>';
                $rows[$key]['owners'] = $owner;

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

    static public function countCompanies()
    {
        return Company::count();
    }

}
