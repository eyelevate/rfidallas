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

    public function prepareTableRows($rows)
    {
        

        // check if exists
        if (isset($rows)) {
            foreach ($rows as $key => $value) {

                // append last column to table here
                $last_column = '<div class="btn-group" role="group">';
                $last_column .= '<button id="btnGroupDrop-'.$value->id.'" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Options</button>';
                $last_column .= '<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">';
                $last_column .= '<a class="dropdown-item" href="'.route('fees_edit',$value->id).'">Edit</a>';
                $last_column .= '<a class="dropdown-item text-danger" data-toggle="modal" data-target="#deleteModal-'.$value->id.'" href="#" style="z-index:9999;">Delete</a>';
                $last_column .= '</div></div>';
                $rows[$key]['action'] = $last_column;
            }
        }

        return $rows;
    }
}
