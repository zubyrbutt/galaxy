<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YccSupportMessage extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }
    public function assigned()
    {
        return $this->belongsTo(User::class, 'assinged_to')->withDefault();
    }

    public function assets()
    {
        return $this->hasMany(YccSupportMessageAttachment::class,'message_id');
    }
}
