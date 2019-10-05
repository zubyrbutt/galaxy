<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EndService extends Model
{
    public function endservicechecklist(){
        return $this->hasOne(UserEndServiceChecklist::class,'document_id','id')->withDefault();
    }

}
