<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projectmessageasset extends Model
{
    protected $fillable = [
        'attachment','orginalfilename',
        
    ];
        
    protected $dates = [   
        'created_at',
        'updated_at'
    ];
    public function message()
    {
        return $this->belongsTo('App\Projectmessage', 'message_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
