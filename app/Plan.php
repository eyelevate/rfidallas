<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;
    

    public function planSchedule()
    {
    	return $this->hasMany(PlanSchedule::class);
    }
}
