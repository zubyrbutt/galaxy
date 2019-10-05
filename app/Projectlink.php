<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projectlink extends Model
{
    protected $fillable = [
        'title','linkurl',
    ];
        
    protected $dates = [   
        'created_at',
        'updated_at'
    ];
    public function project()
    {
        return $this->belongsTo('App\Project', 'project_id');
    }

    public function createdby()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
