<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table ='inventories';

    public function inventoryCategory()
    {
		return $this->belongsTo('App\InventoryCategory', 'category_id');
    }
}
