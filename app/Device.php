<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use SoftDeletes;

    public function deviceHistory()
    {
    	return $this->hasMany(DeviceHistory::class);
    }
}
