<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $fillable =[
		'name', 'status' ,'user_id','last_modified_by'
	];
	
	protected $dates = [
		'created_at',
		'updated_at'
	];
	
	public function createdby(){
		return $this->belongsTo('App\User','user_id');
	}
    
    public function modifiedby(){
		return $this->belongsTo('App\User','last_modified_by');
	}

}
