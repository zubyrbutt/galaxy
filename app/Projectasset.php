<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projectasset extends Model
{
    protected $fillable = [
        //'note','attachment','project_id', 'user_id',
        'note','attachment',
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
    
}
