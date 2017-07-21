<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use SoftDeletes;

    public function assets()
    {
    	// companies may have many devices
    	// one device may be applied to one company
    	return $this->belongsToMany(Asset::class);
    }

    public function deviceHistory()
    {
    	return $this->hasMany(DeviceHistory::class);
    }
}
