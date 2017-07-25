<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

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

    public function prepareTableIssueColumns()
    {

        $columns =  [
            [
                'label'=>'Action',
                'field'=> 'action',
                'html'=>true
            ], [
                'label'=>'First',
                'field'=> 'first_name',
                'filterable'=> true
            ], [
                'label'=>'Last',
                'field'=> 'last_name',
                'filterable'=> true
            ], [
                'label'=>'Email',
                'field'=> 'email',
                'filterable'=> true
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

    public function prepareTableIssueRows($rows)
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

    static public function countMembers($role_id)
    {
        return User::where('role_id',$role_id)->count();
    }



}
