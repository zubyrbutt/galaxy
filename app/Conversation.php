<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    //
	protected $fillable =[
		'message','lead_id','appointment_id','created_by'
	];
	
	protected $dates = [
		'created_at',
		'updated_at'
	];
	
	public function lead(){
		return $this->belongsTo('App\Lead','lead_id');
	}
	
	public function createdby(){
		return $this->belongsTo('App\User','created_by');
	}
	
	public function appointment(){
		return $this->belongsTo('App\Appointment','appointment_id');
	}
	
}
