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

    public function callback()
    {
        return $this->belongsTo('App\callback', 'callback_id');
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
