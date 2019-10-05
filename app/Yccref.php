<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Yccref extends Model
{
    protected $fillable = [
        'name','email', 'contactno', 'country', 'subject', 'message','shift','source', 'status',
    ];
	
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function createdby()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function modifiedby()
    {
        return $this->belongsTo('App\User', 'modified_by');
    }
	
	public function refstatus()
    {
		return $this->hasMany('App\Yccrefstatus', 'yccref_id');
    }

    public function lastrefstatus()
    {
        return $this->hasOne('App\Yccrefstatus', 'yccref_id')->with('createdby')->orderBy('created_at', 'desc');
    }
    
}
