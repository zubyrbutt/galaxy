<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserChecklist extends Model
{
    public function documentname(){
    	return $this->hasOne(UserDocument::class,'id','document_id')->withDefault();
    }
}
