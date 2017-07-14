<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use SoftDeletes;
    

    public function planSchedule()
    {
    	return $this->hasMany(PlanSchedule::class);
    }
}
