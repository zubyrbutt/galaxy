<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentdetail extends Model
{
    //
	protected $fillable = [
        'id','user_id','gender'
    ];
	
    protected $dates = [
        'created_at',
        'updated_at',
		'dob'
    ];
	

}
