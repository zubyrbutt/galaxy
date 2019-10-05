<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEndServiceChecklist extends Model
{
    public function endservicechecklist(){
        return $this->hasOne(UserChecklist::class,'document_id','id')->withDefault();
    }
}
