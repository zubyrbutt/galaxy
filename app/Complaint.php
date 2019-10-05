<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function department()
    {
        return $this->belongsTo('App\Department', 'department_id')->withDefault();
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'complaint_id');
    }
}
