<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEndService extends Model
{
    public function documentname(){
    	return $this->hasOne(UserDocument::class,'id','document_id')->withDefault();
    }
}
