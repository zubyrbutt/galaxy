<?php

namespace App;

use App\Department;
use Illuminate\Database\Eloquent\Model;

class StaffRequired extends Model
{
    public function department(){
    	return $this->hasOne(Department::class,'id','department_id');
    }
    public function user(){
        return $this->hasOne(User::class,'id','requestedby')->withDefault();
    }
}
