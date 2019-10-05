<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffRequiredStatus extends Model
{
    public function updatedby(){
        return $this->hasOne(User::class,'id','updatedBy')->withDefault();
    }
}
