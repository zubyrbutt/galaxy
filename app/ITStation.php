<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ITStation extends Model
{
    protected $table ='it_stations';

    public function room()
    {
		return $this->hasOne('App\Room','id','room_id')->withDefault();
    }

    public function floor()
    {
		return $this->hasOne('App\Floor','id','floor_id')->withDefault();
    }
}
