<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YccSupport extends Model
{
    public function attachments()
    {
        return $this->hasMany(YccSupportAttachments::class, 'ycc_supports_id', 'id')->orderBy('type');
    }

    public function assigneduser(){
        return $this->hasOne(User::class,'id','assignedto')->withDefault();
    }
    
    public function assignedbyuser(){
        return $this->hasOne(User::class,'id','assignedby')->withDefault();
    }
    public function feedback(){
        return $this->hasOne(YccSupportFeedback::class,'support_id')->withDefault();
    }

    public function assigns(){
        return $this->hasOne(YccSupportStatus::class,'yccsupport_id')->withDefault();
    }
}
 