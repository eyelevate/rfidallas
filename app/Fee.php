<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fee extends Model
{
    //
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'desc',
        'pretax'
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
                'label'=>'Subtotal',
                'field'=> 'pretax',
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
                'label'=>'Subtotal',
                'field'=> 'pretax',
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
                $last_column = '<button type="button" class="select-pre-fee btn btn-success btn-sm" fee-id="'.$value->id.'" fee-name="'.$value->name.'" fee-price="'.$value->price.'">Select</button>';
                $last_column .= '</div>';
                $rows[$key]['action'] = $last_column;
            }
        }

        return $rows;
    }

    // Post rows
    public function prepareTableSelectPostRows($rows)
    {
    
        // check if exists
        if (isset($rows)) {
            foreach ($rows as $key => $value) {
                // append last column to table here
                $last_column = '<button type="button" class="select-post-fee btn btn-success btn-sm" fee-id="'.$value->id.'" fee-name="'.$value->name.'" fee-price="'.$value->price.'">Select</button>';
                $last_column .= '</div>';
                $rows[$key]['action'] = $last_column;
            }
        }

        return $rows;
    }

    // Cancel rows
    public function prepareTableSelectCancelRows($rows)
    {
    
        // check if exists
        if (isset($rows)) {
            foreach ($rows as $key => $value) {
                // append last column to table here
                $last_column = '<button type="button" class="select-cancel-fee btn btn-success btn-sm" fee-id="'.$value->id.'" fee-name="'.$value->name.'" fee-price="'.$value->price.'">Select</button>';
                $last_column .= '</div>';
                $rows[$key]['action'] = $last_column;
            }
        }

        return $rows;
    }

    static public function countFees()
    {
        return Fee::count();
    }
}
