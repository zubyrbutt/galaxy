<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    //
	protected $fillable = [
        'name','description',
    ];
	
    protected $dates = [
        'created_at',
        'updated_at' 
    ];
	
	public function customer()
    {
		return $this->belongsTo('App\User', 'user_id');
    }

    public function createdby()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

}
