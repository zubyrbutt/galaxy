<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryQuantity extends Model
{
    protected $table ='inventory_quantity';

    public function issuseFor(){
        return $this->hasOne(User::class, 'id', 'user_id' )->withDefault();
    }

    public function createdby(){
        return $this->hasOne(User::class, 'id', 'created_by' )->withDefault();
    } 
}
