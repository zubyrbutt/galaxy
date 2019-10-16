<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leadstatus extends Model
{
    protected $dates = [
        'created_at',
        'updated_at'
    ];
    public function lead()
    {
        return $this->belongsTo('App\Lead');
    }

    public function createdby()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
