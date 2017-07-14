<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    public function devices()
    {
    	// companies may have many devices
    	// one device may be applied to one company
    	return $this->belongsToMany(Device::class);
    }

}
