<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\AssetItem;
use App\AssetItemHistory;

class Asset extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'desc'
    ];

    public function assetItems()
    {
    	// companies may have many devices
    	// one device may be applied to one company
    	return $this->hasMany(AssetItem::class);
    }


    public function prepareAssetForSelect($data)
    {
        $select = [''=>'Select Asset Group From List'];
        if (count($data) > 0)
        {
            foreach ($data as $key => $value) {
                $full_name = $value->name;
                $select[$value->id] = $full_name;
            }
        }
        return $select;
    }

    public function prepareTableData($data)
    {
    	$ai = new AssetItem;
        $aih = new AssetItemHistory;
    	if (count($data) > 0) {
    		foreach ($data as $key => $value) {
    			if (count($data[$key]['assetItems'])) {
    		
    				$data[$key]['assetItems'] = $ai->prepareTableRows($data[$key]['assetItems']);

                    foreach ($data[$key]['assetItems'] as $aikey => $aivalue) {
                        if(isset($data[$key]['assetItems'][$aikey]['assetItemHistory']))
                        {
                            foreach ($data[$key]['assetItems'][$aikey]['assetItemHistory'] as $aihkey => $aihvalue) {
                                if (isset($data[$key]['assetItems'][$aikey]['assetItemHistory'][$aihkey]['type']))
                                {
                                    $data[$key]['assetItems'][$aikey]['assetItemHistory'][$aihkey]['type_set'] = $aih->convertTypeToText($aihvalue->type);
                                }
                            }
                        }
                    }

    			}
    		}
    	}

    	return $data;
    }
}
