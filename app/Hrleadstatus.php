<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hrleadstatus extends Model
{
    protected $fillable =[
		'status','remarks','recordinglink','hrlead_id','interviewdate'
	];
	
	protected $dates = [
		'created_at',
        'updated_at',
        'interviewdate'
	];
    
    public function createdby(){
		return $this->belongsTo('App\User','user_id');
	}
    
    public function hrlead(){
		return $this->belongsTo('App\Hrlead','hrlead_id');
	}
}
 