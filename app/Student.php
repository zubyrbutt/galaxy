<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
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
	
	public function role(){
        return $this->hasOne(Role::class, 'id', 'role_id' );
    }
	
//Dont use following here
/* 	public function parent_name(){
		return $this->belongsTo('App\User','parent_id','id');
	} */
}
