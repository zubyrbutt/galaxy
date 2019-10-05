<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parentdetail extends Model
{
    //
	protected $fillable = [
		'id','user_id','countryID',
	];
	
	protected $dates = [
		'created_by',
		'updated_by',
	];
}
