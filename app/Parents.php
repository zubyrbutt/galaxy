<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    //
	    protected $fillable = [
        'fname','lname', 'email', 'password',
    ];
	
	    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
	
/* 	public function rolename{
		return $this->belongsTo('App\Role','role_id');
	} */
	    public function role(){
        return $this->hasOne(Role::class, 'id', 'role_id' );
    }
	
	public function extension(){
		return $this->belongsTo('App\Extension','extId');
	}

}
