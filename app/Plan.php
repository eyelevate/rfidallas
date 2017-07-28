<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'desc',
        'pre',
        'price',
        'post',
        'cancel',
        'hourly',
        'daily',
        'weekly',
        'monthly',
        'yearly',
        'start',
        'end',
        'status'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start',
        'end'
    ];

    public function cancelFees()
    {
    	return $this->belongsToMany(Fee::class,'cancel_fee_plan');
    }

    public function preFees()
    {
    	return $this->belongsToMany(Fee::class,'pre_fee_plan');
    }
    public function postFees()
    {
    	return $this->belongsToMany(Fee::class,'post_fee_plan');
    }

    public function serviceFees()
    {
        return $this->belongsToMany(Service::class,'plan_service');   
    }

    public function planSchedule()
    {
    	return $this->hasMany(PlanSchedule::class);
    }

    public function prepareTableColumns()
    {

        $columns =  [
            [
                'label'=>'Name',
                'field'=> 'name',
                'filterable'=> true
            ], [
                'label'=>'Description',
                'field'=> 'desc',
                'filterable'=> true
            ], [
                'label'=>'Pre',
                'field'=> 'pre',
                'filterable'=> true
            ], [
                'label'=>'Sub',
                'field'=> 'price',
                'filterable'=> true
            ], [
                'label'=>'Post',
                'field'=> 'post',
                'filterable'=> true
            ], [
                'label'=>'Cancel',
                'field'=> 'cancel',
                'filterable'=> true
            ], [
                'label'=>'Start',
                'field'=> 'start',
                'type'=>'date',
                'inputFormat'=> 'YYYY-MM-DD HH:MM:SS',
                'outputFormat'=> 'MM/DD/YY'
            ], [
                'label'=>'End',
                'field'=> 'end',
                'type'=>'date',
                'inputFormat'=> 'YYYY-MM-DD HH:MM:SS',
                'outputFormat'=> 'MM/DD/YY'
            ], [
                'label'=>'Status',
                'field'=> 'status',
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

    public function prepareTableSelectColumns()
    {

        $columns =  [
            [
                'label'=>'Name',
                'field'=> 'name',
                'filterable'=> true
            ], [
                'label'=>'Description',
                'field'=> 'desc',
                'filterable'=> true
            ], [
                'label'=>'Pre',
                'field'=> 'pre',
                'filterable'=> true
            ], [
                'label'=>'Sub',
                'field'=> 'price',
                'filterable'=> true
            ], [
                'label'=>'Post',
                'field'=> 'post',
                'filterable'=> true
            ], [
                'label'=>'Cancel',
                'field'=> 'cancel',
                'filterable'=> true
            ], [
                'label'=>'Start',
                'field'=> 'start',
                'type'=>'date',
                'inputFormat'=> 'YYYY-MM-DD HH:MM:SS',
                'outputFormat'=> 'MM/DD/YY'
            ], [
                'label'=>'End',
                'field'=> 'end',
                'type'=>'date',
                'inputFormat'=> 'YYYY-MM-DD HH:MM:SS',
                'outputFormat'=> 'MM/DD/YY'
            ], [
                'label'=>'Status',
                'field'=> 'status',
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

    public function prepareTableRows($rows, $role = 1)
    {
        

        // check if exists
        if (isset($rows)) {
            foreach ($rows as $key => $value) {
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
                // append last column to table here
                $last_column = '<button type="button" class="select-employee btn btn-success btn-sm" employee-id="'.$value->id.'" employee-first-name="'.$value->first_name.'" employee-last-name="'.$value->last_name.'" employee-email="'.$value->email.'">Select</button>';
                $last_column .= '</div>';
                $rows[$key]['action'] = $last_column;
            }
        }

        return $rows;
    }

    static public function countPlans()
    {
        return Plan::count();
    }
}
