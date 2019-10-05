<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adjustment extends Model
{
    protected $fillable =[
		'dated', 'description','type','amount','user_id', 'status' ,'created_by','modified_by'
	];
	
	protected $dates = [
        'dated',
        'created_at',
		'updated_at'
	];
	
    public function applicant(){
		return $this->belongsTo('App\User','user_id')->withDefault();
    }
    
    public function createdby(){
		return $this->belongsTo('App\User','created_by')->withDefault();
	}
    
  public function modifiedby(){
		return $this->belongsTo('App\User','modified_by')->withDefault();
	}

	public function approvedby(){
		return $this->belongsTo('App\User','approved_by')->withDefault();
	}

}
 