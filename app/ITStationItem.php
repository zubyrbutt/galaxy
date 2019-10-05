<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ITStationItem extends Model
{
    protected $table ='it_station_items';

    public function inventories()
     {
		 return $this->hasOne('App\Inventory','id', 'inventory_id')->withDefault();
    }

    public function inventorySNO()
     {
		 return $this->hasOne('App\InventoryItemSno', 'id','inventory_sno_id')->withDefault();
    }
}
