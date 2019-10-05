<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projectmessage extends Model
{
    protected $fillable = [
        'message','user_type','message_type',
        
    ];
        
    protected $dates = [   
        'created_at',
        'updated_at'
    ];
    public function project()
    {
        return $this->belongsTo('App\Project', 'project_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function assets()
    {
		return $this->hasMany('App\Projectmessageasset','message_id');
    }
}
