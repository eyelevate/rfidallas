<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 
        'last_name',
        'phone',
        'email', 
        'role_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    // public function companies()
    // {
    //     return $this->hasMany(Company::class);
    // }

    public function companies()
    {
        // companies may have many devices
        // one device may be applied to one company
        return $this->belongsToMany(Company::class);
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function prepareTableColumns()
    {

        $columns =  [
            [
                'label'=>'First',
                'field'=> 'first_name',
                'filterable'=> true
            ], [
                'label'=>'Last',
                'field'=> 'last_name',
                'filterable'=> true
            ], [
                'label'=>'Phone',
                'field'=> 'phone',
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
                'outputFormat'=> 'MMM Do YY'
            ], [
                'label'=>'Updated',
                'field'=> 'updated_at',
                'type'=>'date',
                'inputFormat'=> 'YYYY-MM-DD HH:MM:SS',
                'outputFormat'=> 'MM/DD/YY hh:mm:ss a'
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
                $last_column .= '<a class="dropdown-item" href="'.route('customers_edit',$value->id).'">Edit</a>';
                $last_column .= '<a class="dropdown-item text-danger" href="'.route('customers_destroy',$value->id).'">Delete</a>';
                $last_column .= '</div></div>';
                $rows[$key]['action'] = $last_column;
            }
        }

        return $rows;
    }


}
