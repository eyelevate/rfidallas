<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
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
        'hourly',
        'daily',
        'weekly',
        'monthly',
        'yearly'
    ];



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
                'label'=>'Hourly',
                'field'=> 'hourly',
                'filterable'=> true
            ], [
                'label'=>'Daily',
                'field'=> 'daily',
                'filterable'=> true
            ], [
                'label'=>'Weekly',
                'field'=> 'weekly',
                'filterable'=> true
            ], [
                'label'=>'Monthly',
                'field'=> 'monthly',
                'filterable'=> true
            ], [
                'label'=>'Yearly',
                'field'=> 'yearly',
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
                'field'=> 'name',
                'filterable'=> true
            ], [
                'label'=>'Description',
                'field'=> 'desc',
                'filterable'=> true
            ], [
                'label'=>'Hourly',
                'field'=> 'hourly',
                'filterable'=> true
            ], [
                'label'=>'Daily',
                'field'=> 'daily',
                'filterable'=> true
            ], [
                'label'=>'Weekly',
                'field'=> 'weekly',
                'filterable'=> true
            ], [
                'label'=>'Monthly',
                'field'=> 'monthly',
                'filterable'=> true
            ], [
                'label'=>'Yearly',
                'field'=> 'yearly',
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
                $last_column = '<button type="button" class="select-service btn btn-success btn-sm" service-id="'.$value->id.'">Select</button>';
                $last_column .= '</div>';
                $rows[$key]['action'] = $last_column;
            }
        }

        return $rows;
    }

    static public function countServices()
    {
        return Service::count();
    }
}
