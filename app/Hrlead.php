<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hrlead extends Model
{
    
    protected $fillable =[
		'name','email','mobile','department_id','status','user_id','last_modified_by'
	];
	
	protected $dates = [
		'created_at',
		'updated_at',
		'interviewdate'
	];
    
    public function createdby(){
			return $this->belongsTo('App\User','user_id');
		}
    
    public function modifiedby(){
			return $this->belongsTo('App\User','last_modified_by');
    }
    public function department(){
			return $this->belongsTo('App\Department','department_id');
		}	

}
