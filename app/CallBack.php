<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CallBack extends Model
{
    protected $fillable = [
        'appointtime','note',
    ];

    protected $dates = [
        'appointtime',
        'created_at',
        'updated_at'
    ];
    public function lead()
    {
        return $this->belongsTo('App\Lead', 'lead_id')->withDefault();
    }

    public function createdby()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
    public function assignedTo()
    {
        return $this->belongsTo('App\User', 'id');
    }
    public function callbackuser_id()
    {
        return $this->belongsTo('App\callBackUser', 'id' , 'call_back_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    public function conversations()
    {
        return $this->hasMany('App\Conversation');
    }


}
