<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
    public function userschecklist(){
    	return $this->hasOne(UserChecklist::class,'document_id','id')->withDefault();
    }
}
