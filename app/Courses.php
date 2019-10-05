<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    //
		protected $fillable = [
        'id','courses'
    ];
	
	protected $dates = [
        'created_at',
        'updated_at' 
    ];
}
