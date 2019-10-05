<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ycclead extends Model
{
    /*protected $fillable = [
        'businessName','businessNature', 'description', 'user_id',
    ];*/
	
    /*protected $dates = [
        'created_at',
        'updated_at'
    ];*/
	
	public function leadstatus()
    {
		return $this->hasMany('App\Yccleadstatus', 'ycclead_id');
    }

    public function lastleadstatus()
    {
        return $this->hasOne('App\Yccleadstatus', 'ycclead_id')->with('createdby')->orderBy('created_at', 'desc');
    }
    
}
