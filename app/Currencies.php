<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currencies extends Model
{
    //
		protected $fillable = [
        'id','one_gbp_to_usd','one_usd_to_usd','one_cad_to_usd','one_aud_to_usd','one_nzd_to_usd','one_sgd_to_usd',
		'one_pkr_to_usd',
    ];
	
	protected $dates = [
		'date',
        'created_at',
        'updated_at' 
    ];
}
