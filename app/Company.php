<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    public function assetItems()
    {
    	// companies may have many devices
    	// one device may be applied to one company
    	return $this->belongsToMany(AssetItem::class);
    }

    public function user()
    {
    	return $this->belongsToOne(User::class);
    }

    public function prepareCompanyForSelect($data)
    {
        $select = [''=>'Select Company From List'];
        if (count($data) > 0)
        {
            foreach ($data as $key => $value) {
                $full_name = isset($value->nick_name) ? $value->name.' ('.$value->nick_name.')' : $value->name;
                $select[$value->id] = $full_name;
            }
        }
        return $select;
    }

}
