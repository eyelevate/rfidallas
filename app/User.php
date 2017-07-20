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
                'label'=>'ID',
                'field'=> 'id',
                'filterable'=> true
            ], [
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
                $last_column = '<div class="btn-group" role="group">';
                $last_column .= '<button id="btnGroupDrop-'.$value->id.'" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Options</button>';
                $last_column .= '<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">';
                switch ($role) {
                    case 1:
                        $route_edit = 'partners_edit';
                        break;
                    case 2:
                        $route_edit = 'managers_edit';
                        break;
                    case 3:
                        $route_edit = 'employees_edit';
                        break;        
                    default:
                        $route_edit = 'customers_edit';
                        break;
                }
                $last_column .= '<a class="dropdown-item" href="'.route($route_edit,$value->id).'">Edit</a>';
                $last_column .= '<a class="dropdown-item text-danger" data-toggle="modal" data-target="#deleteModal-'.$value->id.'" href="#" style="z-index:9999;">Delete</a>';
                $last_column .= '</div></div>';
                $rows[$key]['action'] = $last_column;
            }
        }

        return $rows;
    }


}
