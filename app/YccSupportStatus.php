<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YccSupportStatus extends Model
{
    public function assigned_by(){
    	return $this->belongsTo(User::class, 'assignedby')->withDefault(); 
    }
    public function assigned_to(){
    	return $this->belongsTo(User::class, 'assignedto')->withDefault(); 
    }

    
}
